async function loadPayments() {
    try {
        const response = await fetch('http://localhost:5000/api/payments');
        const payments = await response.json();
        const paymentList = document.getElementById('paymentList');
        paymentList.innerHTML = '';
        payments.forEach(payment => {
            const li = document.createElement('li');
            li.innerHTML = `<strong>Order ID:</strong> ${payment.OrderID} | <strong>Amount:</strong> ${payment.Amount} | <strong>Method:</strong> ${payment.PaymentMethod}`;
            paymentList.appendChild(li);
        });
    } catch (error) {
        console.error('Error fetching payments:', error);
    }
}

document.getElementById('paymentForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const customerId = document.getElementById('customerId').value;
    const amount = document.getElementById('amount').value;
    const paymentMethod = document.getElementById('paymentMethod').value;

    try {
        const response = await fetch('http://localhost:5000/api/payments', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ customerId, amount, paymentMethod })
        });
        if (response.ok) {
            document.getElementById('paymentForm').reset(); // Clear form
            loadPayments(); // Reload payments after adding
        }
    } catch (error) {
        console.error('Error adding payment:', error);
    }
});

// Load payments when the page loads
loadPayments();