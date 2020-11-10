function Validemail()
{
    var email = document.getElementById('email').value;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value)) 
    {
      alert('Please provide a valid email address');
      email.focus;
      return false;
    }
}
