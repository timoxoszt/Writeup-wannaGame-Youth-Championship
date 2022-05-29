function SavePhoto(inp) 
{
    let formData = new FormData();
    let photo = inp.files[0];

    formData.append("file_upload", photo);
    
    fetch('/upload.php', {method: "POST", body: formData})
		 .then(r => r.text())
		 .then(data => {
			  result.innerHTML = data;
		});
}