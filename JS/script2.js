const modal2 = document.getElementById('modal');
        const openModalBtn2 = document.getElementById('openModalBtn');
        modal2.style.display = 'flex';
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
            window.history.replaceState({}, document.title, window.location.pathname);
        });
        openModalBtn.addEventListener('click', () => {
            modal2.style.display = 'flex';
        });

        function checkValidity(event) {
            let email = document.getElementById(`email`).value;
            let password = document.getElementById(`password`).value;

            if (password == '' || email == '') {
                window.alert(`One or more required field is empty!`);
                return false;
            }

            if (password.length < 8) {
                window.alert(`The password is NOT 8-Characters long`);
                return false;
            }

            window.alert(`Form Submitted Successfully`);
            return true;
        }

        document.getElementById("form").onsubmit = checkValidity;