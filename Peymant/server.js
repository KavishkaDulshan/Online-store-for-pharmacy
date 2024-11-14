javascript
     const express = require('express');
     const app = express();
     const paymentRoutes = require('./routes/payments');
     app.use(express.json());

     // Use the payment routes
     app.use('/api/payments', paymentRoutes);

     app.listen(5000, () => {
         console.log('Server is running on port 5000');
     });
