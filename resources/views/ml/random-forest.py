import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.ensemble import RandomForestClassifier
from sklearn.metrics import classification_report
import seaborn as sns
import matplotlib.pyplot as plt
from sklearn.metrics import confusion_matrix
import joblib

# Salary mapping with no gaps
def map_salary(salary):
    try:
        salary = float(salary)
    except:
        return 0  # Unknown/missing
    if salary <= 10000:
        return 1  # Low income
    elif salary <= 40000:
        return 2  # Lower middle income
    elif salary <= 100000:
        return 3  # Middle income
    elif salary <= 130000:
        return 4  # Upper middle income
    else:
        return 5  # High income

# Load dataset
data = pd.read_csv('admissions_data.csv')

# Clean Salary column (remove commas, spaces, handle missing)
data['Salary'] = data['Salary'].astype(str).str.replace(',', '').str.strip()
data['Salary'] = data['Salary'].apply(map_salary)

# Clean GWA column (handle missing, convert to numeric)
data['GWA'] = pd.to_numeric(data['GWA'], errors='coerce')
data = data.dropna(subset=['Salary', 'GWA'])

# Define a more balanced admit logic (example: GWA >= 85 and Salary <= 3)
data['Admit'] = ((data['GWA'] >= 85) & (data['Salary'].isin([1, 2]))).astype(int)

# Check class balance
print(data[['Salary', 'GWA', 'Admit']].head())
print(data['Admit'].value_counts())

# Select features and target
X = data[['Salary', 'GWA']]
y = data['Admit']

# Split into training and testing datasets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42, stratify=y)

# Train the Random Forest model
model = RandomForestClassifier(random_state=42)
model.fit(X_train, y_train)

# Evaluate the model
y_pred = model.predict(X_test)
print(classification_report(y_test, y_pred))

# Confusion matrix
cm = confusion_matrix(y_test, y_pred)
print("Confusion Matrix:\n", cm)
sns.heatmap(cm, annot=True, fmt='d')
plt.xlabel('Predicted')
plt.ylabel('Actual')
plt.show()

# Compare actual vs predicted
comparison = pd.DataFrame({'Actual': y_test, 'Predicted': y_pred})
print(comparison.head(10))

# Save the trained model
joblib.dump(model, 'admission_random_forest_model.pkl')

# Load the model for predictions
model = joblib.load('admission_random_forest_model.pkl')

# New data for prediction
new_data = pd.DataFrame({
    'Salary': [15000, 5000, 120000],
    'GWA': [86, 90, 80]
})

new_data['Salary'] = new_data['Salary'].apply(map_salary)

# Make predictions
predictions = model.predict(new_data)
print(predictions)