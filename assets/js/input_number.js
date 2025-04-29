document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-control').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const input = this.parentNode.querySelector('.quantity-input');
            let value = parseInt(input.value);
            
            if(this.classList.contains('quantity-up')) {
                value = isNaN(value) ? 1 : value + 1;
            } else if(this.classList.contains('quantity-down') && value > 1) {
                value = value - 1;
            }
            
            input.value = value;
            input.dispatchEvent(new Event('change'));
        });
    });
});