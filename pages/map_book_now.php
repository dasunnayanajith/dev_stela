<form action="mail.php" method="POST" class="contact-form style2">

    <h3 class="sec-title mb-30">Book a Tour</h3>

    <div class="row">

        <!-- Title -->
        <div class="form-group col-3">
            <select name="title" class="form-select nice-select" required>
                <option value="" disabled selected>Title</option>
                <option>Mr.</option>
                <option>Mrs.</option>
                <option>Ms.</option>
                <option>Miss.</option>
                <option>Dr.</option>
                <option>Prof.</option>
            </select>
        </div>

        <!-- Full Name -->
        <div class="form-group col-9">
            <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
        </div>

        <!-- Email -->
        <div class="form-group col-6">
            <input type="email" name="email" class="form-control" placeholder="Your Mail" required>
        </div>

        <!-- Contact -->
        <div class="form-group col-6">
            <input type="text" name="contact" class="form-control" placeholder="Contact No" required>
        </div>

        <!-- Date Range -->
        <div class="form-group col-6">
            <input type="text" id="dateRangePicker" name="date_range" class="form-control" placeholder="Date Range" readonly required>
        </div>

        <!-- Persons -->
        <div class="form-group col-6">
            <input type="text" id="personSelector" name="persons" class="form-control" placeholder="Select Persons" readonly required>

            <div id="personPopup" class="person-selector-popup">
                <div class="counter-container">
                    <label>Adults:</label>
                    <button type="button" onclick="updateCounter('adults', -1)">-</button>
                    <span id="adults">0</span>
                    <button type="button" onclick="updateCounter('adults', 1)">+</button>
                </div>

                <div class="counter-container">
                    <label>Children:</label>
                    <button type="button" onclick="updateCounter('children', -1)">-</button>
                    <span id="children">0</span>
                    <button type="button" onclick="updateCounter('children', 1)">+</button>
                </div>

                <div class="counter-container">
                    <label>Rooms:</label>
                    <button type="button" onclick="updateCounter('rooms', -1)">-</button>
                    <span id="rooms">0</span>
                    <button type="button" onclick="updateCounter('rooms', 1)">+</button>
                </div>

                <button type="button" onclick="closePopup()">Done</button>
            </div>
        </div>

        <!-- Country -->
        <div class="form-group col-4">
            <input type="text" name="country" class="form-control" placeholder="Country">
        </div>

        <!-- Accommodation -->
        <div class="form-group col-4">
            <select name="accommodation" class="form-control nice-select">
                <option value="" disabled selected>Accommodation</option>
                <option>5 Star Hotels</option>
                <option>4 Star Hotels</option>
                <option>3 Star Hotels</option>
                <option>Luxury Boutiques</option>
                <option>Wallet Friendly</option>
            </select>
        </div>

        <!-- Found Us -->
        <div class="form-group col-4">
            <select name="found_us" class="form-control nice-select">
                <option value="" disabled selected>Found Us</option>
                <option>Tripadvisor</option>
                <option>Website</option>
                <option>Google</option>
                <option>Social Media</option>
                <option>Other</option>
            </select>
        </div>

        <!-- Message -->
        <div class="form-group col-12">
            <textarea name="message" class="form-control" placeholder="Your Message"></textarea>
        </div>

        <div class="form-btn col-12">
            <button type="submit" class="th-btn style3">
                Send Message
            </button>
        </div>

    </div>
</form>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.getElementById('personSelector').addEventListener('click', function() {
    document.getElementById('personPopup').classList.toggle('active');
});

function updateCounter(type, change) {
    const el = document.getElementById(type);
    let count = parseInt(el.textContent);
    el.textContent = Math.max(0, count + change);
    updatePersonText();
}

function updatePersonText() {
    const a = adults.textContent;
    const c = children.textContent;
    const r = rooms.textContent;
    document.getElementById('personSelector').value =
        `${a} Adults, ${c} Children, ${r} Room${r > 1 ? 's' : ''}`;
}

function closePopup() {
    document.getElementById('personPopup').classList.remove('active');
}

flatpickr("#dateRangePicker", {
    mode: "range",
    dateFormat: "d M Y"
});
</script>
<!--==============================
Map Area  
==============================-->
    <div class="">
        <div class="container-fluid">
            <div class="contact-map style2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d1979.6639938990295!2d80.017571!3d7.087925!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1723311068981!5m2!1sen!2slk" allowfullscreen="" loading="lazy"></iframe>
                    <div class="contact-icon">
                    <img src="assets/img/icon/location-dot3.svg" alt="">
                </div>
            </div>
        </div>
    </div>
