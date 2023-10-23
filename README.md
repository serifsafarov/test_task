# How to run
## Config
Configuration files are in ```config``` directory. You will need to add ```exchange rates api_key``` there. 

Source file with transactions should be placed in root and named ```input.txt```. Default file from task is already there
## Run 
Run ```make run``` command to start main container. Application will be available by link http://localhost:6002/
## Run inline
Run ```make run-inline``` to get response in console. In this case Nginx will not start and container will show result and exit
## Tests
To run unit tests run ```make run-tests``` command