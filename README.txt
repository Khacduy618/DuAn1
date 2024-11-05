# DuAn1
Dự án 1 PRO1014 
Các bước thực hiện git
git clone dự án
git init
git pull
git branch ( kiểm tra nhánh)
git branch feature (tạo nhánh mới tên là feature)
git checkout feature (di chuyển sang nhánh feature)
git status (kiểm tra trạng thái)
git add . (Thêm tất cả các file mới tạo)
git commit -m 'text' (Commit lại thay đổi)
git checkout main ( rời khỏi nhánh vừa thay đổi) 
git push origin feature (Đẩy lên github với nhánh feature mới tạo và commit code)
git branch -D feature (xóa nhánh feature tại máy) 

Mỗi lần sửa đổi phải tạo nhánh feature, sửa đổi trong nhánh đó rồi git add và commit rồi push lại , sau đó xóa nhánh đó tại máy. 
//Mọi thắc mắc comment vô đây!!!!

/// cụ thể hơn 
- git init 
- git remote add origin https://github.com/Khacduy618/DuAn1.git 
- ssh-keygen -t ed25519 -C "your_email@example.com" 
- cat ~/.ssh/id_ed25519.pub 
được keys vào cài đặt Nhập key xong 
- git clone git@github.com:Khacduy618/DuAn1.git
là đươc
