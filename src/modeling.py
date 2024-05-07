import pandas as pd
import numpy as np
import copy
import utils as utils
from sklearn.ensemble import RandomForestClassifier
from xgboost import XGBClassifier

from sklearn.model_selection import RandomizedSearchCV
from sklearn.metrics import roc_auc_score, f1_score


# define param
def create_model_param():
    """Create the model objects"""
    
    rf_params = {
        "n_estimators" : [i for i in range(50, 151, 30)],
        "min_samples_split" : [2, 4, 6, 8],
        "criterion" : ["gini", "entropy", "log_loss"]
    }
    
    xgb_params = {
        'n_estimators': [5, 10, 25, 50]
    }

    # Create model params
    list_of_param = {
        'RandomForestClassifier': rf_params,
        'XGBClassifier': xgb_params,
    }

    return list_of_param


def create_model_object():
    """Create the model objects"""
    print("Creating model objects")

    # Create model objects
    rf = RandomForestClassifier()
    xgb = XGBClassifier()

    # Create list of model
    list_of_model = [
        {'model_name': rf.__class__.__name__, 'model_object': rf},
        {'model_name': xgb.__class__.__name__, 'model_object': xgb}
    ]

    return list_of_model


from sklearn.model_selection import StratifiedKFold
from sklearn.metrics import confusion_matrix, accuracy_score

def train_model(return_file=True):
    """Function to get the best model"""
    # Load dataset
    X_train = utils.pickle_load(CONFIG_DATA['train_clean_path'][0])
    y_train = utils.pickle_load(CONFIG_DATA['train_clean_path'][1])
    X_valid = utils.pickle_load(CONFIG_DATA['valid_clean_path'][0])
    y_valid = utils.pickle_load(CONFIG_DATA['valid_clean_path'][1])
    
    # Create list of params & models
    list_of_param = create_model_param()
    list_of_model = create_model_object()

    # List of trained model
    list_of_tuned_model = {}
    
    # Define StratifiedKFold for cross-validation
    skf = StratifiedKFold(n_splits=3, shuffle=True, random_state=123) 

    # Train model
    for base_model in list_of_model:
        # Current condition
        model_name = base_model['model_name']
        model_obj = copy.deepcopy(base_model['model_object'])
        model_param = list_of_param[model_name]

        # Debug message
        print('Training model :', model_name)

        # Create model object
        model = RandomizedSearchCV(estimator = model_obj,
                                   param_distributions = model_param,
                                   n_iter=5,
                                   cv=skf,  # Use StratifiedKFold
                                   random_state = 123,
                                   n_jobs=1,
                                   verbose=10,
                                   scoring = 'accuracy')
        
        # Train model
        model.fit(X_train, y_train)

        # Predict
        # y_pred_proba_train = model.predict_proba(X_train)[:, 1]
        # y_pred_proba_valid = model.predict_proba(X_valid)[:, 1]
        
        # Prediksi probabilitas & calculate AUC score
        y_pred_train = model.predict(X_train)
        y_pred_valid = model.predict(X_valid)

        # Menghitung AUC dengan asumsi klasifikasi multi-kelas
        
        ''' 
        One vs One: OvO lebih cocok untuk dataset yang lebih kecil karena lebih sedikit data yang digunakan pada masing-masing klasifikator, 
        sementara One-vs-Rest (OvR) / One-vs-All (OvA) lebih efisien dalam hal waktu komputasi untuk dataset yang besar atau dengan banyak kelas.
        '''
        cm_train = confusion_matrix(y_train, y_pred_train)
        cm_valid = confusion_matrix(y_valid, y_pred_valid)
        acc_train = accuracy_score(y_train, y_pred_train)
        acc_valid = accuracy_score(y_valid, y_pred_valid)

        # Append
        list_of_tuned_model[model_name] = {
            'model': model,
            'train_cm': cm_train,
            'valid_cm': cm_valid,
            'train_accuracy': acc_train,
            'valid_accuracy': acc_valid,
            'best_params': model.best_params_
        }

        print("Done training")
        print("")

    # Dump data
    utils.pickle_dump(list_of_param, CONFIG_DATA['list_of_param_path'])
    utils.pickle_dump(list_of_model, CONFIG_DATA['list_of_model_path'])
    utils.pickle_dump(list_of_tuned_model, CONFIG_DATA['list_of_tuned_model_path'])

    if return_file:
        return list_of_param, list_of_model, list_of_tuned_model    

def get_best_model(return_file=True):
    """Function to get the best model based on validation accuracy"""
    # Load tuned model
    list_of_tuned_model = utils.pickle_load(CONFIG_DATA['list_of_tuned_model_path'])

    # Get the best model based on validation accuracy
    best_model_name = None
    best_model = None
    best_performance = -1  # Initialize to -1 since accuracy cannot be negative
    best_model_param = None

    for model_name, model_info in list_of_tuned_model.items():
        # Extract validation accuracy
        valid_accuracy = model_info['valid_accuracy']
        
        if valid_accuracy > best_performance:
            best_model_name = model_name
            best_model = model_info['model']
            best_performance = valid_accuracy
            best_model_param = model_info['best_params']

    # Dump the best model
    utils.pickle_dump(best_model, CONFIG_DATA['best_model_path'])

    # Print the summary of the best model
    print('=============================================')
    print('Best model        :', best_model_name)
    print('Validation accuracy:', best_performance)
    print('Best model params :', best_model_param)
    print('=============================================')

    if return_file:
        return best_model


if __name__ == '__main__':
    # 1. Load configuration file & Set Threshold
    CONFIG_DATA = utils.config_load()

    # 2. Train & Optimize the model
    train_model()

    # 3. Get the best model
    get_best_model()