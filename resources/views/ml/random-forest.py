import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import classification_report
import joblib

# Salary mapping based on the provided criteria
def map_salary(salary):
    if salary <= 10000:
        return 1  # Low income
    elif 11000 <= salary <= 40000:
        return 2  # Lower middle income
    elif 41000 <= salary <= 100000:
        return 3  # Middle income
    elif 101000 <= salary <= 130000:
        return 4  # Upper middle income
    else:
        return 5  # High income

# Load dataset
data = pd.read_csv('admissions_data.csv')

# Map Salary to numeric values
data['Salary'] = data['Salary'].apply(map_salary)

# Define the target variable based on the criteria
data['Admit'] = ((data['GWA'] > 85) & (data['Salary'] == 1)).astype(int)

# Check data
print(data[['Salary', 'GWA', 'Admit']].head())

# Ensure balanced classes
print(data['Admit'].value_counts())

# Select features and target
X = data[['Salary', 'GWA']]  # Features
y = data['Admit']  # Target

# Split into training and testing datasets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train the Random Forest model
model = RandomForestClassifier(random_state=42)
model.fit(X_train, y_train)

# Evaluate the model
y_pred = model.predict(X_test)
print(classification_report(y_test, y_pred))

# Compare actual vs predicted
comparison = pd.DataFrame({'Actual': y_test, 'Predicted': y_pred})
print(comparison.head(10))

# Save the trained model
joblib.dump(model, 'admission_random_forest_model.pkl')

# Load the model for predictions
model = joblib.load('admission_random_forest_model.pkl')

# New data for prediction
new_data = pd.DataFrame({
    'Salary': [15000, 5000, 120000],  # Replace with actual salary values
    'GWA': [86, 90, 80]  # Replace with actual GWA values
})

# Map new data salaries to numeric values
new_data['Salary'] = new_data['Salary'].apply(map_salary)

# Make predictions
predictions = model.predict(new_data)
print(predictions)