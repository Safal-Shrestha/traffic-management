function login() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Simple authentication logic for demonstration
    if (username === 'admin' && password === 'admin') {
        window.location.href = 'admin.html';
    } else if (username === 'client' && password === 'client') {
        window.location.href = 'client.html';
    } else {
        alert('Invalid credentials. Please try again.');
    }
}
function pay()
{
    window.location.href = 'Payment.html';
}
function fine()
{
    window.location.href='client.html';
}
