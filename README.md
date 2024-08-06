# User Management CRUD Application

This project is a CRUD (Create, Read, Update, Delete) application for managing users. It includes a real-time updating grid using WebSockets and is built with PHP, Ratchet, Docker, and Nginx.

## Getting Started

Follow these instructions to get a copy of the project up and running on your local machine.

### Prerequisites

- Docker
- Docker Compose
- Composer

### Installation

1. **Clone the repository**
	- <git clone https://github.com/JoaoVCCaetano/user_management.git>
	
2. **Install Composer dependencies for the main project:**
	- <composer install>
	
3. **Install Composer dependencies for the WebSocket server:**
	- <cd docker/websocket composer install>
	
4. **Build and run the Docker containers**
	- <docker-compose up -d --build>
	
5. **Access the application:**
	- Open your browser and navigate to 'http://localhost:8000/users'
	
**Features:**
*- CRUD operations for user management*
*- Real-time updates using WebSockets*
*- SweetAlert2 for user-friendly notifications*
