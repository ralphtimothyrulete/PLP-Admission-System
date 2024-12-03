import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import classification_report
import joblib

# Manual Salary Mapping
salary_mapping = {
    'Low-income': 1,
    'Lower-middle-income': 2,
    'Middle-income': 3,
    'Upper-middle-income': 4,
    "High-income group": 5
}

# Load dataset
data = pd.read_csv('admissions_data.csv')

# Map Salary to numeric values
data['Salary'] = data['Salary'].map(salary_mapping)

# Define the target variable
data['Admit'] = ((data['GWA'] >= 85) & (data['Salary'].isin([1, 2]))).astype(int)

# Check data
print(data[['Salary', 'GWA', 'Admit']].head())

# Ensure balanced classes
print(data['Admit'].value_counts())

# Select features and target
X = data[['Salary', 'GWA']]  # Features
y = data['Admit']  # Target

# Split into training and testing datasets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train the Logistic Regression model
model = LogisticRegression()
model.fit(X_train, y_train)

# Evaluate the model
y_pred = model.predict(X_test)
print(classification_report(y_test, y_pred))

# Save the trained model
joblib.dump(model, 'admission_model.pkl')

# Load the model for predictions
model = joblib.load('admission_model.pkl')

# New data for prediction
new_data = pd.DataFrame({
    'Salary': [3, 2],  # Replace with actual salary mappings
    'GWA': [84, 88]  # Replace with actual GWA values
})

# Make predictions
predictions = model.predict(new_data)
print(predictions)
