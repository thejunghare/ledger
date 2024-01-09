/*!
 * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
 * Copyright 2013-2023 Start Bootstrap
 * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
 */
//
// Scripts
//

"use strict";

window.addEventListener("DOMContentLoaded", (event) => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector("#sidebarToggle");
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener("click", (event) => {
            event.preventDefault();
            document.body.classList.toggle("sb-sidenav-toggled");
            localStorage.setItem(
                "sb|sidebar-toggle",
                document.body.classList.contains("sb-sidenav-toggled")
            );
        });
    }

    /*todo validate amount at client side*/

    const getamount = document.querySelector("#amount");
    const showwarning = document.querySelector("#showerror");
    const displayerror = document.querySelector("#displayerror");

    getamount.oninput = function () {
        console.log(getamount.value);
        amount = getamount.value;
        if (amount <= 0) {
            alert("Enter amount greater than 0");
        }
    };

    document
        .querySelector("#addbudgetform")
        .addEventListener("submit", function (event) {
            let amount = getamount.value;
            if (amount <= 0) {
                event.preventDefault();
                //console.log("Input value cannot be smaller than 0")
                //showwarning.innerText = 'Amount shpuld be greater than 0'

                displayerror.innerHTML = `Amount should be greater than '₹.0'`;
            }
        });

    /*todo: fill the date with current date at client side*/
    let today = new Date();
    let date = String(today.getDate()).padStart(2, "0");
    let month = String(today.getMonth() + 1).padStart(2, "0");
    let year = today.getFullYear();
    today = year + "-" + month + "-" + date;
    console.log(today);
    const setdate = document.querySelector("#date");
    setdate.value = today;


});
