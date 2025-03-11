# Inventory Management Application

## Overview
A web-based inventory management application built with Laravel and Filament. The application provides features for analyzing product stock, checking character similarity between inputs, and managing incoming and outgoing products.

## Features

### 1. Analyze Product
This feature allows users to analyze the current state of products in inventory and receive recommendations based on stock availability and sales trends.

#### Process:
- Retrieves available and unavailable products.
- Determines the top-selling products.
- Calculates total stock value.
- Generates recommendations based on inventory status.

#### Example Output:
- "Many products are out of stock! Restock immediately."
- "Top-selling product: Product A. Keep the stock available!"

### 2. Check Input Similarity
A tool to compare two user inputs and calculate the percentage of unique characters from the first input that exist in the second input.

#### Example:
- **Input 1**: `ABBCD`
- **Input 2**: `Gallant Duck`
- Matched characters: `A, D, C` (3 out of 5 unique characters in input 1)
- **Result**: `60% match`

### 3. Incoming Product
A module to record the addition of new stock into inventory.

#### Features:
- Add new stock with details such as product name, quantity, and date.
- Automatically updates product stock in the database.
- Tracks stock history.

### 4. Outcoming Product
A module to record products leaving inventory (sales or transfers).

#### Features:
- Deducts stock from inventory based on outcoming quantity.
- Tracks transaction history.
- Prevents transactions if stock is insufficient.

## Technology Stack
- **Backend**: Laravel 12 (MVC architecture)
- **Frontend**: Filament
- **Database**: SQLite/MySQL/PostgreSQL
- **Authentication**: Laravel Breeze (or Filament Auth)

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/inventory-app.git
   cd inventory-app
   ```
2. Install dependencies:
   ```bash
   composer install
   npm install && npm run build
   ```
3. Set up environment:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Configure database in `.env` file and run migrations:
   ```bash
   php artisan migrate --seed
   ```
5. Start the development server:
   ```bash
   php artisan serve
   ```

## Usage
- Access the application via `http://localhost:8000`
- Log in using the admin credentials (if seeded)
- Navigate through the dashboard to manage inventory

## License
This project is licensed under the MIT License.
