<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .tab-container {
            width: 80%;
            margin: 0 auto;
            margin-top: 50px;
        }

        .tabs {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            border-bottom: 2px solid #ccc;
            position: relative;
        }

        .tab-button {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            border: none;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            position: relative;
        }

        .tab-button:hover {
            background-color: #ddd;
        }

        .tab-button.active {
            background-color: #fff;
            border-bottom: 2px solid #4CAF50;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid transparent;
            border-top: none;
        }

        .tab-content.active {
            display: block;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
        }

        .form-row {
            display: flex;
            width: 100%;
            margin-bottom: 20px;
        }

        .form-row label,
        .form-row input {
            /* width: calc(50% - 10px); */
        }

        .form-row label {
            margin-right: 20px;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .heading {
            text-align: center;
            padding-bottom: 2rem;
            color: #4846a6;
            font-weight: bold;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .form-group {
            flex: 0 0 48%;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn_next {
            background-color: #4846a6;
            padding: 0.5rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            color: white;
            border-color: #4846a6;

            margin-top: 1rem;
        }

        .btn_next-out {
            background-color: white;
            border-color: #4846a6;
            padding: 0.5rem;
            padding-left: 1.5rem;
            padding-right: 1.5rem;
            color: #4846a6;
            margin-top: 1rem;
        }

        h2 {
            color: #4846a6;
            font-weight: lighter;
        }

        p {
            color: #808080;
            line-height: 1.5rem;
        }

        @media (max-width:557px) {
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="tab-container">
        <h2 class="heading">INSTRUCTORS FORM</h2>
        <div class="tabs">
            <button class="tab-button active" onclick="openTab(event, 'PersonalInfo')">1. Personal Information</button>
            <button class="tab-button" onclick="openTab(event, 'Qualification')">2. Qualification</button>
            <button class="tab-button" onclick="openTab(event, 'Referees')">3. Referees</button>
            <button class="tab-button" onclick="openTab(event, 'AdditionalDetails')">4. Additional Details</button>
        </div>
        <div id="PersonalInfo" class="tab-content active">
            <h2>Post Details:</h2>
            <form>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">Post Applied for</label>
                        <input type="text" id="firstName" name="post">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Categories</label>
                        <input type="text" id="lastName" name="Categories">
                    </div>
                </div>
                <h2>Personal Information:</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Title (Mr, Mrs, etc.)</label>
                        <input type="text" id="email" name="Title">
                    </div>
                    <div class="form-group">
                        <label for="phone">First Name</label>
                        <input type="text" id="phone" name="f_name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Last Name</label>
                        <input type="text" id="email" name="l_name">
                    </div>
                    <div class="form-group">
                        <label for="phone">Passport / ID Number</label>
                        <input type="text" id="phone" name="passport">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Date of Birth</label>
                        <input type="text" id="email" name="dob">
                    </div>
                    <div class="form-group">
                        <label for="phone">Gender</label>
                        <input type="text" id="phone" name="gender">
                    </div>
                </div>

                <h2>Address Details:</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Address</label>
                        <input type="text" id="email" name="address">
                    </div>
                    <div class="form-group">
                        <label for="phone">City</label>
                        <input type="text" id="phone" name="city">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Zip/Postal Code</label>
                        <input type="text" id="email" name="zip">
                    </div>
                    <div class="form-group">
                        <label for="phone">Country</label>
                        <input type="text" id="phone" name="country">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Mobile Number
                        </label>
                        <input type="text" id="email" name="number">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="p_number">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Preferred Contact Method</label>
                        <input type="text" id="phone" name="contact_methode">
                    </div>
                </div>
                <button type="button" class="btn_next tab-button"
                    onclick="openTab(event, 'Qualification')">Next</button>

        </div>
        <div id="Qualification" class="tab-content">
            <h2>Qualifications:</h2>
            <p>Please list any qualifications you have gained or are undertaking (e.g degree, professional
                qualifications) If you are shortlisted for interview you will be required to produce original
                certificates (or other documentary proof of qualifications) where these are specified as an essential
                requirement of the post. If you need to add further qualifications, please put these in the Relevant
                Skills and Experience section.</p>
            <div class="form-group">
                <label for="email">Particulars of academic and technical qualifications</label>
                <input type="text" id="email" name="academic">
            </div>

            <h2>Relevent Skills and Experince:</h2>
            <p>Please show by giving examples of any experiences, behaviours and skills of how you meet the selection
                criteria listed for the post. You may use duties in your present or previous jobs and any other areas
                such as temporary work, voluntary work, studies or spare-time activities. Please be specific and give
                examples wherever possible - these can be drawn from any aspect of your life. This field will expand as
                necessary to contain your details.</p>
            <div class="form-group">
                <label for="email">Relevant Skills & Experience (Please type here)</label>
                <input type="text" id="email" name="exp">
            </div>

            <button type="button" class="btn_next-out" onclick="openTab(event, 'PersonalInfo')">Pervious</button>
            <button type="button" class="btn_next" onclick="openTab(event, 'Referees')">Next</button>

        </div>
        <div id="Referees" class="tab-content">
            <h2>Referess:</h2>
            <p style="marging-bott">Please give detail if of at least one referee who can confirm that you meet the
                selection criteria for
                the past. Your referees should not be related to you in any way nor writing solely as a colleague or
                friend. If you are (or have recently been) a student, one should be a senior staff member from your
                place of study.</p>
            <p>If you are not currently working with children or young people but have done so in the past, one referee
                should be that employer i.e. the Head of the Establishment Please note that for school roles we normally
                take up references of all shortlisted candidates and may approach previous employers for information to
                verify particular experience or qualifications before interview</p>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Referees Title</label>
                    <input type="text" id="email" name="refress_title">
                </div>
                <div class="form-group">
                    <label for="phone">First Name:</label>
                    <input type="text" id="phone" name="f-name">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Surname (Family name)</label>
                    <input type="text" id="email" name="surname">
                </div>
                <div class="form-group">
                    <label for="phone">Position or relationship to you</label>
                    <input type="text" id="phone" name="relationship">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Address</label>
                    <input type="text" id="email" name="address">
                </div>
                <div class="form-group">
                    <label for="phone">Zip/Postal Code</label>
                    <input type="text" id="phone" name="zip">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Mobile Number
                    </label>
                    <input type="tel" id="email" name="mob-no">
                </div>
                <div class="form-group">
                    <label for="phone">Email</label>
                    <input type="email" id="phone" name="email">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">May we contact this referee without further authority from you?
                    </label>
                    <input type="text" id="email" name="refree-no">
                </div>

            </div>
            <button type="button" class="btn_next-out" onclick="openTab(event, 'Qualification')">Pervious</button>
            <button type="button" class="btn_next" onclick="openTab(event, 'AdditionalDetails')">Next</button>
        </div>
        <div id="AdditionalDetails" class="tab-content">
            <h2>Additional Details:</h2>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">When would you be available to start work?</label>
                    <input type="text" id="email" name="start_work">
                </div>
                <div class="form-group">
                    <label for="phone">Where did you see this post advertised?</label>
                    <input type="text" id="phone" name="advertised">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Please provide details of where you saw this post</label>
                    <input type="text" id="email" name="deatils">
                </div>

            </div>

            <h2>
                Data Protection Statement:
            </h2>
            <p style="margin-bottom:1rem;">We will use the information you have provided on this application form,
                together with other information
                we may obtain about you, e.g from your referees and from carrying out security or CRB checks (when such
                checks are relevant to the post), to assess your suitability for employment with us, for administration
                and management purposes and for statistical analysis. We may disclose your information to our service
                providers, our related companies within our holding company ( ALZO Edutech Group) and agents for these
                purposes and by submitting this application form you are consenting to our processing this for the
                purposes above.</p>

            <p>If your application is unsuccessful, we will keep your information for 12 months in accordance with legal
                requirements and for administration purposes.</p>


            <h2>
                Equal Opportunities:
            </h2>
            <p style="margin-bottom:1rem;">We are on equal opportunity employer and is committed to promoting equality
                and social inclusion. We operate a policy whose aim is to ensure that unlawful or otherwise
                unjustifiable discrimination does not take place in recruitment.

            </p>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Documents (Passport/Qualifications/Transcripts and certificates/ Any other
                        Supporting Documents)</label>
                    <input type="file" id="email" name="file">
                </div>

            </div>


            <h2>
                Declaration:
            </h2>
            <p style="margin-bottom:1rem;">You cannot sign this form on screen. By submitting this form as an email
                attachment you undertake that the information you have provided is true and accurate to the best of your
                knowledge. You may be required to sign your application at a later stage of the selection process. The
                information i have given on this form is true and accurate to the best of my knowledge, I confirm that I
                have read the data protection statement contained in this document.

            </p>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Date</label>
                    <input type="date" id="email" name="date">
                </div>

            </div>

            <button type="button" class="btn_next-out" onclick="openTab(event, 'Referees')">Pervious</button>
            <button type="submit" class="btn_next">Submit</button>

        </div>
        </form>
    </div>
    <script>
        function openTab(event, tabName) {
            var i, tabcontent, tabbuttons;

            // Hide all tab content
            tabcontent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].classList.remove("active");
            }

            // Remove active class from all tab buttons
            tabbuttons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabbuttons.length; i++) {
                tabbuttons[i].classList.remove("active");
            }

            // Show the current tab content and add active class to the clicked tab button
            document.getElementById(tabName).classList.add("active");
            event.currentTarget.classList.add("active");
        }

        // Set the default active tab
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector('.tab-button').click();
        });
    </script>
    <script src="script.js"></script>
</body>

</html>
