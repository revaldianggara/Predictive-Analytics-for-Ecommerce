# Predictive Analytics for E-Commerce

## Installation for frontend

**requirements**
PHP version 8.3.1
turn on pdo sqlite3 on php.ini

1. Open terminal in the root of this project and do following command:
~~~
install.sh
~~~
---OR ---
~~~
composer install
copy .env.example .env //or just copy the .env.example as .env
php artisan key:generate
~~~
2. Configure the .env file
3. do `php artisan migrate --seed`
##


## Installation for backend

1. clone repository

2. create environment variables and activate
```
conda create --name skilvul python=3.11
conda activate skilvul
```
You can change the env {skilvul} as you like

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
python3 modeling.py
```

5. For trial & error, you can use the jupyter notebook file which has already created the execution sequence
##

