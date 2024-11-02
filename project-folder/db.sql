 sql
     CREATE TABLE Payment (
         PaymentID INT AUTO_INCREMENT PRIMARY KEY,
         OrderID INT,
         Amount DECIMAL(10, 2) NOT NULL,
         PaymentDate DATETIME DEFAULT CURRENT_TIMESTAMP,
         PaymentMethod VARCHAR(50),
         FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
     );
