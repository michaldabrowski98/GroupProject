up:
	cd backend; docker-compose up -d
	cd frontend; docker-compose up -d
down:
	cd backend; docker-compose down
	cd frontend; docker-compose down
setup:
	cd backend; docker-compose up --build -d
	cd frontend; docker-compose up --build -d
