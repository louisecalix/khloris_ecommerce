document.querySelectorAll('.bttn_qty').forEach(button => {
    button.addEventListener('click', () => {
        // Get the current value of currlist from sharedState
        let currlist = window.sharedState.currlist;

        const selected = parseInt(button.getAttribute('data-qty'), 10);

        switch (selected) {
            case 3:
                currlist = flwr3;
                document.getElementById("three_qty").style.display = 'flex';
                document.getElementById("five_qty").style.display = 'none';
                document.getElementById("seven_qty").style.display = 'none';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(0.25)';
                break;
            case 5:
                currlist = flwr5;
                document.getElementById("five_qty").style.display = 'flex';
                document.getElementById("three_qty").style.display = 'flex';
                document.getElementById("seven_qty").style.display = 'none';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(10)';
                break;
            case 7:
                currlist = flwr7;
                document.getElementById("seven_qty").style.display = 'flex';
                document.getElementById("three_qty").style.display = 'flex';
                document.getElementById("five_qty").style.display = 'flex';
                document.getElementById("ten_qty").style.display = 'none';
                document.getElementById("wrapper").style.transform = 'scale(0.96)';
                break;
            case 10:
                currlist = flwrs;
                document.getElementById("ten_qty").style.display = 'flex';
                document.getElementById("three_qty").style.display = 'flex';
                document.getElementById("five_qty").style.display = 'flex';
                document.getElementById("seven_qty").style.display = 'flex';
                document.getElementById("wrapper").style.transform = 'scale(1)';
                break;
            default:
                currlist = flwrs;
        }

        curr_flower = 0;
        update_flower();
    });
});
