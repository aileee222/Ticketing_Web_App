const submit_profil = document.querySelector('#form_submit');
submit_profil.addEventListener("submit", async(event) => {
        event.preventDefault();
        const firstname = document.querySelector('.firstname_entry').value.trim() || "";
        const lastname = document.querySelector('.lastname_entry').value.trim() || "";
        const email = document.querySelector('.email').textContent.trim() || "";
        const birthday = document.querySelector('.birthday_entry').value.trim() || "";
        const tel = document.querySelector('.phone_entry').value.trim() || "";
        const location = document.querySelector('.location_entry').value.trim() || "";
        const education = document.querySelector('.education_entry').value.trim() || "";

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch(submit_profil.action, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({firstname, lastname, email, birthday, tel, location, education})
        });
        const data = await res.json();
        if (res.ok && data.success) {
            window.location.href = '../profile';
        } else {
            console.log(data);
        }
});
