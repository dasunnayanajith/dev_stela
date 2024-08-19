<!--==============================
Video Area  
==============================-->
<div class="space-extra2-top space-extra2-bottom" data-bg-src="assets/img/bg/video_bg_1.jpg">
        <div class="container">
            <div class="row flex-row-reverse justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="video-box1">
                        <a href="https://www.youtube.com/watch?v=7h4wud3HMZQ" class="play-btn style2 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>
                    </div>
   
                </div>
                <div class="col-lg-6">
                    <div>
                        <form action="mail.php" method="POST" class="contact-form style2 ajax-contact">
                            <h3 class="sec-title mb-30 text-capitalize">Book a tour</h3>
                            <div class="row">
                                <div class="form-group col-3">
                                    <select name="subject" id="subject" class="form-select nice-select">
                                        <option value="Select Tour Type" selected disabled>Title</option>
                                        <option value="Mr.">Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                        <option value="Ms.">Ms.</option>
                                        <option value="Miss.">Miss.</option>
                                        <option value="Dr.">Dr.</option>
                                        <option value="Prof.">Prof.</option>
                                    </select>
                                </div>
                                <div class="col-9 form-group">
                                    <input type="text" class="form-control" name="name" id="name3" placeholder="Full Name">
                                    <img src="assets/img/icon/user.svg" alt="">
                                </div>
                                <div class="col-6 form-group">
                                    <input type="email" class="form-control" name="email3" id="email3" placeholder="Your Mail">
                                    <img src="assets/img/icon/mail.svg" alt="">
                                </div>
                                
                                <div class="col-6 form-group">
                                    <input type="contact" class="form-control" name="contact3" id="contact3" placeholder="Contact No">
                                    <img src="assets/img/icon/chat.svg" alt="">
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" id="dateRangePicker" class="form-control" placeholder="Date Range" readonly>
                                </div>
                                <div class="form-group col-6">
                                    <input type="text" id="personSelector" class="form-control" placeholder="Select Persons" readonly>
                                    <div id="personPopup" class="person-selector-popup">
                                        <div class="counter-container">
                                            <label for="adults">Adults:</label>
                                            <div class="counter-buttons">
                                                <button type="button" onclick="updateCounter('adults', -1)">-</button>
                                                <span id="adults">0</span>
                                                <button type="button" onclick="updateCounter('adults', 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-container">
                                            <label for="children">Children:</label>
                                            <div class="counter-buttons">
                                                <button type="button" onclick="updateCounter('children', -1)">-</button>
                                                <span id="children">0</span>
                                                <button type="button" onclick="updateCounter('children', 1)">+</button>
                                            </div>
                                        </div>
                                        <div class="counter-container">
                                            <label for="rooms">Rooms:</label>
                                            <div class="counter-buttons">
                                                <button type="button" onclick="updateCounter('rooms', -1)">-</button>
                                                <span id="rooms">0</span>
                                                <button type="button" onclick="updateCounter('rooms', 1)">+</button>
                                            </div>
                                        </div>
                                        <button type="button" class="th-btn style3" onclick="closePopup()">Done</button>
                                    </div>
                                </div>

<script>
    document.getElementById('personSelector').addEventListener('click', function() {
        document.getElementById('personPopup').classList.toggle('active');
    });

    function updateCounter(type, change) {
        const countElement = document.getElementById(type);
        let count = parseInt(countElement.textContent);
        count = Math.max(0, count + change); // Prevent negative values
        countElement.textContent = count;
        updatePersonSelectorText();
    }

    function updatePersonSelectorText() {
        const adults = document.getElementById('adults').textContent;
        const children = document.getElementById('children').textContent;
        const rooms = document.getElementById('rooms').textContent;
        document.getElementById('personSelector').value = `${adults} Adults, ${children} Children, ${rooms} Room${rooms > 1 ? 's' : ''}`;
    }

    function closePopup() {
        document.getElementById('personPopup').classList.remove('active');
    }

    // Initialize with default values
    updatePersonSelectorText();
</script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#dateRangePicker", {
        mode: "range",
        dateFormat: "d M Y",
        onClose: function(selectedDates, dateStr, instance) {
            // Optional: Perform an action when dates are selected
            console.log(dateStr); // Logs the selected date range as a string
        }
    });
</script>

                                <div class="col-4 form-group">
                                    <input type="text" class="form-control" name="name" id="name3" placeholder="Country">
                                    <img src="assets/img/icon/map2.svg" alt="">
                                </div>
                                <div class="form-group col-4">
                                    <select name="subject" id="subject" class="form-control nice-select">
                                        <option value="Select Tour Type" selected disabled>Accommodation</option>
                                        <option value="5 Star Hotels">5 Star Hotels</option>
                                        <option value="4 Star Hotels">4 Star Hotels</option>
                                        <option value="3 Star Hotels">3 Star Hotels</option>
                                        <option value="Luxury Boutiques">Luxury Boutiques</option>
                                        <option value="Wallet Friendly">Wallet Friendly</option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <select name="subject" id="subject" class="form-control nice-select">
                                        <option value="Select Tour Type" selected disabled>Found Us</option>
                                        <option value="Africa Adventure">Tripadvisor</option>
                                        <option value="Africa Wild">Website</option>
                                        <option value="Asia">Google</option>
                                        <option value="Scandinavia">Social media</option>
                                        <option value="Western Europe">Other</option>
                                    </select>
                                </div>
                                <div class="form-group col-12">
                                    <textarea name="message" id="message" cols="30" rows="1" class="form-control" placeholder="Your Message"></textarea>
                                    <img src="assets/img/icon/chat.svg" alt="">
                                </div>
                                <div class="form-btn col-12 mt-24"><button type="submit" class="th-btn style3">Send message
                                        <img src="assets/img/icon/plane.svg" alt=""></button>
                                </div>
                            </div>
                            <p class="form-messages mb-0 mt-3"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--==============================
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
