# Local'z

# Local'z - Halal Food & Grocery Marketplace

## Group Information

**Group Name**: Section 2
**Course**: BIIT 2305 Web Application Development

**Group Members** :

| No. | Name | Matric No. | Role / Task |
|-----|------|------------|-------------|
| 1 | Aiman Huzaimi Bin Mohamad Hilmi | 2414169 | Developer |
| 2 | Muhammad Aiman bin Mohamad Salehudin | 2412635 | Developer |
| 3 | Aqil Imran bin Suryawan | 2410353 | Developer |
| 4 | Muhammad Amir Haziq bin Khairulnizam | 2413641 | Developer |
| 5 | Farhan Adib Bin Zamri | 2417295 | Developer |


## Project Overview

Introduction :
Local'z is a web-based halal food and grocery marketplace developed using the Laravel framework with the Bagisto e-commerce platform. The application provides a dedicated online platform for halal-certified products, connecting buyers with local halal vendors. Customers can browse, search, and purchase Shariah-compliant food and grocery items, while vendors manage their storefronts, track sales, and monitor inventory through an intuitive dashboard. Administrators oversee platform authentication and approve Halal Certification verifications to maintain trust and transparency.

## Project Objectives

- Primary Goal: Provide a dedicated online marketplace for halal food and grocery products that ensures transparency and trust
- Technical Goal: Implement Laravel MVC architecture with Bagisto e-commerce framework, featuring full CRUD operations and role-based access control
- User Experience Goal: Allow customers to browse, search, and purchase halal products anytime and anywhere through an intuitive, responsive interface
- Business Goal: Implement Shariah-compliant business practices, including honest product descriptions and transparent pricing, while offering local halal vendors an accessible digital platform to promote and manage their products

## Target Users

- Buyers: Individuals looking to browse and purchase Shariah-compliant halal food and grocery products online
- Vendors: Local halal food and grocery vendors who want to manage their storefronts digitally, track sales, and monitor stock levels
- Administrators: System managers who oversee platform authentication, approve Halal Certification verifications, and manage user accounts


## Features and Functionalities

**Buyer Features**

- User Registration & Login: Secure account creation and authentication
- Product Browsing: Browse available halal food and grocery products across vendor storefronts
- Product Search: Search and filter halal-certified items by category, vendor, or keyword
- Shopping Cart: Add/remove items, modify quantities, view total cost
- Order Placement: Secure checkout process with order confirmation
- Order Tracking: Real-time status updates on order progress
- Order History: View previous orders and reorder functionality
- Product Reviews: Interactive buyer review components to build community trust
- Profile Management: Update personal information and delivery addresses
- Wishlist: Save favourite products for future purchases

**Vendor Features**

- Vendor Dashboard: Overview of orders, sales, and performance metrics
- Storefront Management: Set up and manage digital storefronts with branding
- Product Management: Add, edit, and delete product listings with optimised high-quality imagery (CRUD)
- Inventory Management: Real-time stock updates with low stock monitoring alerts
- Order Management: View incoming orders and update order status
- Sales Analytics: Basic reporting on sales and popular items

**Admin Features**

- Admin Dashboard: Platform-wide overview and system management
- User Management: Manage buyer and vendor accounts
- Halal Certification Verification: Review and approve vendor Halal Certification submissions
- Product Oversight: Oversee all product listings across the platform
- Platform Configuration: Manage system settings, payment gateways, and delivery options

## Technical Implementation

### Technology Stack

- Backend Framework: Laravel 12.x 
- Frontend: Blade Templates 
- Database: MySQL 8.0
- Authentication: Laravel built-in authentication with role-based middleware
- Image Storage: Laravel File Storage
- Search Engine: Elasticsearch 8.x
- Caching: Redis
- Build Tool: Vite 5.x with Laravel Vite Plugin
- Containerisation: Docker with Laravel Sail
- Development Environment: XAMPP / Docker (Laravel Sail)

### Database Design

Database Schema Overview :
Our database consists of core tables designed to handle users, sessions, and agent conversations, complemented by Bagisto's extensive e-commerce schema for products, categories, orders, customers, and vendors.

Core Tables:

- `users` — Admin and system-level user accounts
- `sessions` — User session management with IP tracking
- `agent_conversations` — AI agent conversation records
- `agent_conversation_messages` — Individual messages within agent conversations

Bagisto-Managed Tables (via packages):

- `customers` — Buyer accounts and profile information
- `products` — Product catalog with descriptions, pricing, and images
- `categories` — Hierarchical product categorisation for halal items
- `orders` — Customer order records with payment and shipping details
- `order_items` — Individual items within each order
- `vendors` — Vendor storefront information and settings
- `carts` / `cart_items` — Shopping cart management
- `inventory_sources` — Stock and inventory tracking

### Entity Relationship Diagram (ERD)

> https://drive.google.com/file/d/1PH9yogeQGZMBt5woPhjcPnywMVgTVZTx/view?usp=sharing

Key Relationships:

* **Users to Orders:** One-to-Many
* **Users to Restaurants:** One-to-Many
* **Restaurants to Products:** One-to-Many
* **Orders to Order Items:** One-to-Many
* **Products to Order Items:** One-to-Many
* **Users to Sessions:** One-to-Many
* **Users to Personal Access Tokens:** One-to-Many
* **Users to Password Reset Tokens:** One-to-Many

### Laravel Components Implementation

- Routes (web.php)

```php
// Public Routes 
Route::get('/', [HomeController::class, 'index'])->name('shop.home.index');
Route::get('/products', [ProductController::class, 'index'])->name('shop.products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('shop.products.show');

// Buyer Protected Routes
Route::middleware(['auth', 'customer'])->group(function () {
    Route::get('/customer/account', [AccountController::class, 'index'])->name('customer.account');
    Route::resource('orders', OrderController::class);
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
});

// Vendor Protected Routes
Route::middleware(['auth', 'vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'dashboard'])->name('vendor.dashboard');
    Route::resource('vendor/products', VendorProductController::class);
});

// Admin Protected Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('catalog/products', AdminProductController::class);
    Route::resource('customers', AdminCustomerController::class);
});
```

- Controllers

- AuthenticatedSessionController.php: Handles user login and logout sessions.
- ConfirmablePasswordController.php: Manages password confirmation for sensitive actions.
- EmailVerificationNotificationController.php: Sends email verification links to users.
- EmailVerificationPromptController.php: Displays the screen prompting users to verify their email.
- NewPasswordController.php: Manages the resetting of a user's password.
- PasswordController.php: Handles general password update/management logic.
- PasswordResetLinkController.php: Manages sending password reset email links.
- RegisteredUserController.php: Handles new user registration.
- VerifyEmailController.php: Validates the email verification link clicked by the user.
- AdminController.php: Manages administrative functions and dashboard logic.
- CartController.php: Handles shopping cart operations like adding/removing items.
- Controller.php: The base controller from which other controllers extend.
- ProductController.php: Manages product display, creation, and updates.
- ProfileController.php: Handles user profile view and updates.

- Models and Relationships

```php
// Customer Model
class Customer extends Model {
    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function addresses() {
        return $this->hasMany(Address::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}

// Product Model 
class Product extends Model {
    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }

    public function inventories() {
        return $this->hasMany(ProductInventory::class);
    }
}

// Order Model
class Order extends Model {
    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }
}
```

- Views and User Interface

  *Blade Templates Structure :*
  - `themes/shop/` — Buyer-facing storefront views
    - `default/views/home.blade.php` — Homepage with featured halal products
    - `default/views/products/index.blade.php` — Product browsing and search
    - `default/views/products/view.blade.php` — Individual product details
    - `default/views/checkout/` — Cart and checkout process
    - `default/views/customers/account/` — Customer dashboard and profile
  - `themes/admin/` — Admin panel views
    - `default/views/dashboard/` — Admin dashboard
    - `default/views/catalog/` — Product and category management
    - `default/views/customers/` — Customer management
  - `themes/installer/` — Bagisto installation wizard

  *Design Features:*
  - Responsive Design: Mobile-first approach for all user roles
  - Colour Scheme: Clean and modern theme representing halal and trust
  - Navigation: Intuitive menu structure with user role-based options
  - Interactive Elements: Dynamic cart updates, real-time stock indicators, interactive review components


## User Authentication System

### Authentication Features
- **Registration System**: Email validation, password confirmation, role selection (Buyer/Vendor)
- **Login System**: Secure authentication with "Remember Me" option
- **Password Reset**: Email-based password recovery system
- **Role-Based Access Control (RBAC)**: Implemented using Laravel Middleware to segment user experience securely — separate dashboards for Buyers, Vendors, and Admins
- **Profile Management**: Users can update their personal information and preferences
- **Halal Certification Verification**: Vendors submit certifications; Admins review and approve

### Security Measures
- Password encryption using Laravel's built-in hashing
- CSRF protection on all forms
- Input validation and sanitisation
- Middleware protection for authenticated routes
- Cookie encryption via `EncryptCookies` middleware


## Installation and Setup Instructions

### Prerequisites :
- PHP >= 8.3
- Composer
- Node.js and NPM
- MySQL 8.0
- XAMPP or Docker (Laravel Sail)

### Step-by-Step Installation

1. Clone the Repository & Install Dependencies

```bash
git clone https://github.com/aqilimran/webapp_project.git
cd webapp_project
composer update --ignore-platform-req=php
```

2. Environment Configuration

```bash
cp .env.example .env
```

3. Run the Automated Installer
This will generate the app key, migrate the tables, and seed the database.


4. Launch the Development Server

```bash
php artisan serve
```

### 🌐 Access Points
- Buyer Storefront: http://localhost:8000
- Admin Portal: http://localhost:8000/admin
- Vendor Portal: http://localhost:8000/vendor/login

### Docker Setup (Alternative)

```bash
docker-compose up -d
```

Services included: Laravel (PHP 8.3), MySQL 8.0, Redis, Elasticsearch, Kibana, Mailpit


## Testing and Quality Assurance

### Functionality Testing

- User registration and login system (Buyer, Vendor, Admin)
- Product browsing, searching, and filtering
- Shopping cart add/remove functionality
- Order placement and confirmation
- Order status tracking
- Vendor storefront and product management (CRUD)
- Admin user management and certification approvals
- Inventory stock updates and low stock alerts
- Responsive design across devices

### Browser Compatibility

- ✅ Google Chrome (Latest)
- ✅ Mozilla Firefox (Latest)
- ✅ Safari (Latest)
- ✅ Microsoft Edge (Latest)

### Performance Testing

- Page load times under 3 seconds
- Database queries optimised with Eloquent
- Image compression implemented for product cataloging
- Elasticsearch indexing for fast product search
- Redis caching for improved response times
- Responsive design tested on multiple screen sizes


## Challenges Faced and Solutions

### Challenge 1: PHP Version Conflicts with Bagisto
- **Problem**: Compatibility issues between PHP versions and Bagisto package requirements during initial setup
- **Solution**: Used `composer update --ignore-platform-req=php` to resolve dependency conflicts and aligned the development environment with PHP 8.3

### Challenge 2: Complex Role-Based Access Control
- **Problem**: Segmenting access for three distinct user types (Buyer, Vendor, Admin) with different permissions and dashboards
- **Solution**: Implemented Laravel Middleware to enforce role-based routing and access restrictions, ensuring each user type only accesses their authorised areas

### Challenge 3: Halal Certification Verification Workflow
- **Problem**: Building a reliable process for vendors to submit and admins to review halal certifications
- **Solution**: Created an approval workflow within the admin dashboard with status tracking (Pending, Approved, Rejected) for certification submissions


## Future Enhancements

### Upcoming Phases Features (Potential Improvements)
- **Real-time Notifications**: Push notifications for order updates and stock alerts
- **Payment Integration**: Stripe, PayPal, or local Malaysian payment gateways (FPX, Touch 'n Go)
- **GPS Tracking**: Real-time delivery tracking with maps integration
- **Rating System**: Customer reviews and vendor ratings with trust scores
- **Advanced Analytics**: Detailed sales reports, customer insights, and trend analysis
- **Mobile App**: Native mobile application for iOS and Android
- **Multi-Language Support**: Malay and Arabic language options for wider accessibility
- **AI-Powered Recommendations**: Personalised product suggestions based on purchase history

### Scalability Considerations

- Database optimisation for larger datasets using Elasticsearch
- Redis caching implementation for improved performance
- API development for mobile app integration
- Load balancing for high traffic scenarios
- CDN integration for faster media delivery


## Learning Outcomes

### Technical Skills Gained

- **Laravel Framework**: Understanding of MVC architecture, Eloquent ORM, and middleware
- **Database Design**: Creating efficient database schemas and relationships with MySQL
- **Authentication & RBAC**: Implementing secure role-based user authentication systems
- **Frontend Development**: Building responsive interfaces with Blade templates
- **DevOps**: Working with Docker, Elasticsearch, and Redis in a development environment
- **Version Control**: Using Git and GitHub for collaborative project management

### Soft Skills Developed

- **Team Collaboration**: Working effectively in a five-member group environment
- **Project Management**: Planning and executing a complex web application
- **Problem Solving**: Debugging and resolving technical challenges including PHP version conflicts and Bagisto integration issues
- **Documentation**: Creating comprehensive project documentation


## References

1. Laravel Documentation. (2025). Laravel 12.x Documentation. Retrieved from https://laravel.com/docs/12.x
2. Bagisto Documentation. (2025). Bagisto E-Commerce Framework Documentation. Retrieved from https://devdocs.bagisto.com
3. MySQL Documentation. (2025). MySQL 8.0 Reference Manual. Retrieved from https://dev.mysql.com/doc/refman/8.0/en/
4. Elasticsearch Documentation. (2025). Elasticsearch 8.x Reference. Retrieved from https://www.elastic.co/guide/en/elasticsearch/reference/current/index.html
5. Docker Documentation. (2025). Docker Compose Documentation. Retrieved from https://docs.docker.com/compose/
6. MDN Web Docs. (2025). Web Development Resources. Retrieved from https://developer.mozilla.org/
7. Stack Overflow. (2025). Programming Q&A Platform. Retrieved from https://stackoverflow.com/


## Conclusion

Local'z successfully demonstrates the implementation of a comprehensive halal food and grocery marketplace using the Laravel framework. The project showcases proficiency in web development fundamentals including MVC architecture, database design, role-based user authentication, and responsive web design.

### Key Achievements

- Successfully implemented a functional halal marketplace with three user roles (Buyer, Vendor, Admin) using Laravel Middleware for RBAC
- Created a Halal Certification verification workflow to ensure trust and Shariah-compliance
- Developed a responsive, user-friendly interface for browsing and purchasing halal products
- Demonstrated understanding of database relationships, CRUD operations, and modular architecture
- Applied security best practices for user authentication and data protection

### Project Impact

This project provides practical experience in building real-world e-commerce web applications and demonstrates the ability to work collaboratively in a team environment. By addressing the niche market of halal food and groceries, the platform promotes ethical commerce and supports local halal vendors in digitalising their businesses. The skills gained through this project are directly applicable to professional web development scenarios.


### Team Participation
| 1 | Aiman Huzaimi Bin Mohamad Hilmi | 2414169 | 10/10 |
| 2 | Muhammad Aiman bin Mohamad Salehudin | 2412635 | 10/10 |
| 3 | Aqil Imran bin Suryawan | 2410353 | 10/10 |
| 4 | Muhammad Amir Haziq bin Khairulnizam | 2413641 | 10/10 |
| 5 | Farhan Adib Bin Zamri | 2417295 | 10/10|

- Project Completion Date: 12/6/2026
- Course: BIIT 2305 Web Application Development
