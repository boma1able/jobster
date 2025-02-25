# Jobster

**Jobster** is a learning project built with Laravel, utilizing **Livewire** and **Tailwind CSS**. The project focuses on the admin panel that allows content management.

---

## Table of Contents

- [Structure and Functionality](#structure-and-functionality)
  - [Main Pages](#main-pages)
  - [Commenting System](#commenting-system)
  - [Category and Tag Pages](#category-and-tag-pages)
  - [Jobs and Vacancies](#jobs-and-vacancies)
  - [Authentication and Users](#authentication-and-users)
  - [Footer and Subscription](#footer-and-subscription)
- [Admin Panel](#admin-panel)
  - [Dashboard](#dashboard)
  - [Media](#media)
  - [Posts and Categories](#posts-and-categories)
  - [Jobs](#jobs)
  - [Comments](#comments)
  - [Users](#users)
- [Authentication and Roles](#authentication-and-roles)
- [Additional Functionality](#additional-functionality)
- [404 Page](#404-page)
- [Technologies](#technologies)
- [Setup and Installation](#setup-and-installation)
- [License](#license)

---

## Structure and Functionality

### Main Pages

- **Home Page**
- **Blog Page**
- **Job Page**

### Commenting System

On the individual post page, the following features are implemented:
- A commenting system.
- A list of comments.
- A form to leave a comment (available only to registered users – **Subscribers**).

### Category and Tag Pages

- **Category Pages:** Display posts that belong to the selected category.
- **Tag Pages:** Display posts associated with a specific tag.

### Jobs and Vacancies

- **Jobs Page:** A list of jobs.
  - Includes a link to the vacancy page.

### Authentication and Users

- **Registration:** A form to register a new user.
- **Login/Logout:**
  - A login form, where by default a user is created with the **Subscriber** role.

### Footer and Subscription

- **Footer:** Contains a subscription form where the user can choose which newsletter to subscribe to: posts, vacancies.
- Emails are sent to the user with links to new posts and jobs.

---

## Admin Panel

Utilizes **Livewire** to build dynamic web applications without the need for traditional JavaScript frameworks (such as React or Vue.js).

### Dashboard

- A page that displays statistics:
  - New posts.
  - Jobs.
  - Users.
  - Comments.
  - View counts.

### Media

- A page that displays media files (images) used in posts.

### Posts and Categories

- **Posts Page:**
  - A table containing information about the author, title, description, categories, tags, views, comments, and publication date.
  - Sorting options by date and view count.
  - Functionality to create, edit, and delete posts.
  
- **Categories:**
  - A list of existing categories including name, description, slug, and the number of posts that include the category.
  - Ability to create new categories and edit existing ones.

- **Tags:**
  - A list of existing tags including name, description, slug, and the number of posts that include the tag.
  - Ability to create new tags and edit existing ones.

### Jobs

- **Jobs Page:**
  - Displays information about the job title, description, company, and company logo.
  - A list of all jobs with filtering through search and pagination.
  - Functionality to create a new job, edit, and delete existing ones.

### Comments

- A page that displays information:
  - About the author, content, link to the post where the comment was added, and the publication date.
- Functionality:
  - **Approve/Reject** comments:
    - By default, a comment is in a "pending" state and is not displayed on the post page.
    - Comments from admins are automatically approved.
  - Ability to edit or delete comments.
  - Filtering options:
    - All comments.
    - Current user's comments.
    - Pending (awaiting approval).
    - Approved.

### Users

- A page that displays a list of all users with the following information:
  - ID, name, email.
  - Number of posts and jobs created by the user.
  - User role (Admin, Editor, Subscriber, etc.).
  - Status (user activity: online/offline).
- Functionality:
  - Create a new user.
  - Edit and delete existing users.
  - User profile page.

---

## Authentication and Roles

- A user authentication system is implemented with role-based access.
- A user with the **Subscriber** role (created by default during registration) does not have access to the admin panel (dashboard).
- Password change functionality:
  - "Forgot Password" page.
  - Page to create a new password.

---

## Additional Functionality

- **404 Page** to handle non-existent routes.

---

## Technologies

- **Backend:** Laravel
- **Dynamic Components:** Livewire
- **Styling:** Tailwind CSS

---

## Setup and Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/yourusername/jobster.git
   cd jobster
