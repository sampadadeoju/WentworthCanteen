// Adjust the min ending date range of specific date selection in the revenue selection page
function update_minrange() {
    var start_input = document.getElementById("start_date");
    try {
        var start_date = start_input.value;
    } catch (TypeError) {
        const today = new Date();
        var start_date = today.toISOString().split('T')[0]; // Default to today's date if none is selected
    }
    var end_input = document.getElementById("end_date");
    end_input.min = start_date; // Set the minimum date for end date to the selected start date
}

// Enable or disable the specific date range inputs based on the selected report mode
function switch_disable(status){
    var start_input = document.getElementById("start_date");
    var end_input = document.getElementById("end_date");
    var rev_mode5 = document.getElementById("rev_mode5");
    if(rev_mode5.checked){
        console.log("enable");  // Log for debugging
        start_input.disabled = false;
        end_input.disabled = false;
    } else {
        console.log("disable");  // Log for debugging
        start_input.disabled = true;
        end_input.disabled = true;
    }
}

// Call the update_minrange function when the page is loaded to ensure proper range behavior
window.onload = function() {
    update_minrange();
};
