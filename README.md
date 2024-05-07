# Predictive Analytics for E-Commerce

## Installation

1. clone repository

2. create environment variables and activate
```
conda create --name skilvul python=3.11
conda activate skilvul
```
You can change the <skilvul> as you like

3. Install dependencies.
```
pip install -r requirements.txt
```

4. starts data pipelines and modeling steps:

```
cd src
python3 syntetic_data.py
python3 data_pipeline.py
python3 data_preprocess.py
pythonn3 modeling.py
```

5. For trial & error, you can use the jupyter notebook filter which has already created the execution sequence

6. Load data from the Google Analytics API and start pipelines:

```
bash /opt/ga_epna/ingestion/load_historical_data/load_ga_epna_historical_data.sh
```
