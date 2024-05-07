from faker import Faker
import pandas as pd
import random
from sklearn.preprocessing import LabelEncoder
import utils as utils

CONFIG_DATA = utils.config_load()
raw_dataset_path = CONFIG_DATA['raw_dataset_path'] 

def syntetic_data():
    
    purchase_history = pd.read_csv(raw_dataset_path + '/purchase_history.csv', delimiter=";")
    product_detail = pd.read_csv(raw_dataset_path+ '/product_details.csv', delimiter=";")
    customer_interactions = pd.read_csv(raw_dataset_path + '/customer_interactions.csv', delimiter=",")

    fake = Faker()
    categories = product_detail['category'].unique()

    # Generate purchase_history data
    purchase_history_data = []
    for _ in range(100):
        purchase_history_data.append({
            'customer_id': random.randint(1, 20),
            'product_id': random.randint(1, 105),
            'purchase_date': fake.date_between(start_date='-1y', end_date='today')
        })

    purchase_history = pd.DataFrame(purchase_history_data)

    # Generate product_detail data
    product_detail_data = []
    product_ids = range(1, 106) # generate 100 product_id unik from 1 - 100
    for product_id in product_ids:
        product_detail_data.append({
            'product_id': product_id,
            'category': random.choice(categories),
            'price': random.randint(10, 1000),
            'ratings': round(random.uniform(1, 5), 1)
        })
    product_detail = pd.DataFrame(product_detail_data)

    # Generate customer_interactions data
    customer_interactions_data = []
    for _ in range(100):
        customer_interactions_data.append({
            'customer_id': random.randint(1, 20),
            'page_views': random.randint(1, 50),
            'time_spent': random.randint(30, 300)
        })

    customer_interactions = pd.DataFrame(customer_interactions_data)
    
    return purchase_history, product_detail, customer_interactions


def main():
    purchase_history, product_detail, customer_interactions = syntetic_data()
    purchase_history.to_csv(raw_dataset_path + '/datafaker_purchase_history.csv', index=False)
    product_detail.to_csv(raw_dataset_path +'/datafaker_product_details.csv', index=False)
    customer_interactions.to_csv(raw_dataset_path +'/datafaker_customer_interactions.csv', index=False)

    purchase_details = pd.merge(purchase_history, product_detail, on='product_id', how='left')

    # Merging hasil purchase_details with customer_interactions pada 'customer_id'
    full_data = pd.merge(purchase_details, customer_interactions, on='customer_id', how='left')



    # enocde categoru and Fit standardizer
    encoder = LabelEncoder()
    categories = ['Clothing', 'Home & Kitchen', 'Beauty', 'Electronics']
    encoder.fit(categories)

    full_data['category_encoded'] = encoder.transform(full_data['category'])
    # Check the mapping to confirm it is correct
    category_mapping = dict(zip(encoder.classes_, encoder.transform(encoder.classes_)))
    print("Category Mapping:", category_mapping)

    full_data.to_csv(raw_dataset_path + '/data.csv', index=False)
    
    return full_data

if __name__ == '__main__':
    # syntetic_data()
    main()