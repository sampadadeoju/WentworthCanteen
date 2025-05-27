// Increment the value of the input field with id 'id' by 1, ensuring it doesn't exceed 99
function add_amt(id){
    var amt_bx = document.getElementById(id);
    var amt = amt_bx.value;
    if(amt < 99){
        amt_bx.value = parseInt(amt) + 1; // Ensure it's treated as an integer
    }
}

// Decrement the value of the input field with id 'id' by 1, ensuring it doesn't go below 1
function sub_amt(id){
    var amt_bx = document.getElementById(id);
    var amt = amt_bx.value;
    if(amt > 1){
        amt_bx.value = parseInt(amt) - 1; // Ensure it's treated as an integer
    }
}
