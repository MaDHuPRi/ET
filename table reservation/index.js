function totalPrice(){
       var total = 0
       var children = document.getElementById('children').value;
       var adults = document.getElementById('adults').value;
       total = (children * 599) + (adults * 799);
       totalWithGst = total + 12/100;
       console.log(totalWithGst);
       document.getElementById('totalPrice').innerHTML=totalWithGst;

       }
