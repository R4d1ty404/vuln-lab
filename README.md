# 🧪 PHP Vulnerable Lab

This lab is designed to study various web application vulnerabilities, such as:

-  SQL Injection
-  XSS
-  OS Command Injection
-  LFI / RFI
-  Path Traversal
-  File Upload / Backdoor
-  SSRF

> ⚠️ **Warning**: This application is **intentionally unsafe**. Do not run it on public servers!

## 📦 Instalasi

```bash
git clone https://github.com/R4d1ty404/vuln-lab.git
cd vuln-lab
sudo cp -r * /var/www/html/project/
```

Create a new database (e.g vulnlab) and add this query
```bash
CREATE TABLE userdata (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(15),
  password VARCHAR(15)
);
```

Do not forget to update the db_connect.php file.
Happy Hacking!
