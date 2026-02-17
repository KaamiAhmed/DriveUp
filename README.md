## Website for Driving School and Management System to manage students, their schedule and lessons

It is possible to create new account. This way the person who created the account will be registered as a regular user.

## Flow

- It is required to create an account and to be logged in before booking the trial lesson.
- Once the trial lesson is booked. User receives an email with the details about how the process will proceed ahead.
- After the trial lesson, if student decides to take lessons, admin can change the student type from "trial student" to "regular student" via the Portal and then admin can plan lessons for that student.
- Student will also get access to the Portal and will be able to see the schedule of his/her planned lessons if any.

## Important Functionalities

- Forgot password functionality - It is possible to reset password if the user/student forgets his/her password.
- Management system - Admins can view all the students, plan their lessons(when student type is changed to regular student, "lessons" button for that student will become automatically accessible after 3 seconds and then admin can plan the lessons for that student) and remove them from the system. Students can only view their past and upcoming lessons.
- Reviews - Anyone can submit reviews via the form in the footer and reviews will show in the carousel after the page refresh.

## Efforts for WCAG Compliance

- Sufficient Color contrast has been made sure across the website.
- All the interactive elements are accessible via keyboard (e.g using tabindex property).
- The website is accessible to assistive technologies (e.g using semantic tags like header, main, nav, footer, section etc, using ARIA properties like aria-label, aria-required, aria-hidden etc, using role property where necessary, using label tags for inputs, using alt text for images).

## Efforts for GDPR Compliance

- Cookie banner is displayed when user visits the website to let the user know that we use cookies. As the user clicks accept button, cookie is stored on the browser for 1 month.
- A separate privacy statement page has been created (see in footer).
- Users are asked to agree to the privacy policy while submitting their data/form for booking a trial lesson.
