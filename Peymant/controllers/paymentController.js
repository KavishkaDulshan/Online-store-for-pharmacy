javascript
     const db = require('../server').get('pharmacy_data');

     exports.getPayments = (req, res) => {
         db.query('SELECT * FROM Payment', (err, results) => {
             if (err) res.status(500).json({ error: err.message });
             else res.json(results);
         });
     };

     exports.addPayment = (req, res) => {
         const { orderId, amount, paymentMethod } = req.body;
         const sql = 'INSERT INTO Payment (OrderID, Amount, PaymentMethod) VALUES (?, ?, ?)';
         db.query(sql, [orderId, amount, paymentMethod], (err, result) => {
             if (err) res.status(500).json({ error: err.message });
             else res.json({ id: result.insertId, ...req.body });
         });
     };

     exports.getPaymentById = (req, res) => {
         const sql = 'SELECT * FROM Payment WHERE PaymentID = ?';
         db.query(sql, [req.params.id], (err, result) => {
             if (err) res.status(500).json({ error: err.message });
             else res.json(result[0]);
         });
     };

     exports.deletePayment = (req, res) => {
         const sql = 'DELETE FROM Payment WHERE PaymentID = ?';
         db.query(sql, [req.params.id], (err, result) => {
             if (err) res.status(500).json({ error: err.message });
             else res.json({ message: 'Payment deleted successfully.' });
         });
     };
