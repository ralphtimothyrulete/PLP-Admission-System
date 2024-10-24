# Import necessary libraries
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LogisticRegression
from sklearn.metrics import accuracy_score, classification_report, confusion_matrix
import pandas as pd
import numpy as np

# Sample dataset (replace with your own)
data = {
'Salary': [22, 25, 47, 52, 46, 56, 55, 60, 62, 61, 18, 28],
'GWA': [3.5, 3.7, 3.9, 3.4, 3.8, 3.0, 3.6, 3.1, 3.2, 3.3, 3.4, 3.6],
'Admitted': [1, 1, 1, 0, 1, 0, 1, 0, 0, 1, 1, 0]
}

# Create a DataFrame
df = pd.DataFrame(data)

# Define features (X) and target (y)
X = df[['Salary', 'GWA']]
y = df['Admitted']

# Split data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Create and train Logistic Regression model
model = LogisticRegression()
model.fit(X_train, y_train)

# Make predictions
y_pred = model.predict(X_test)

# Evaluate model
print("Accuracy:", accuracy_score(y_test, y_pred))
print("Classification Report:\n", classification_report(y_test, y_pred))
print("Confusion Matrix:\n", confusion_matrix(y_test, y_pred))