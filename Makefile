run:
	docker compose up --build

run-inline:
	docker compose -f docker-compose-inline.yml up --build

run-tests:
	docker compose -f docker-compose-unit-tests.yml up --build