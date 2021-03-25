# SpecUp
AWS project



What is SpecUp?

New integrated contest platform that is based on cloud service.
Contests have application deadlines and announcement days which causes intensive network connection in specific time frames. This can lead to server freeze if the website is built on on-premise servers. However, if the website is built based on cloud services, it can automatically scale based on current traffic demands and prevent server freezes. 


Architecture

Users can access the website using the domain “specup.click”. For high availability, instances are located in 2 different Availability Zone in the same region. Web Server is located in public subnets under Elastic Load Balancer and Auto Scaling group and RDS MySQL is located in private subnets for extra security. 3 DynamoDB tables each collect data for contest board, entry forms and login sessions. 2 S3 buckets handle large data for contest board and entry forms.

