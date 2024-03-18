
                        const profileImage = document.getElementById('post-image');
                        const profilePhotoInput = document.getElementById('upload_profile_pic');
                        profilePhotoInput.addEventListener('change', function(event) {
                            const selectedFile = event.target.files[0];

                        if (selectedFile) {
                        const reader = new FileReader();

                        reader.onload = function() {
                      profileImage.src = reader.result;
                        };

                    reader.readAsDataURL(selectedFile);
                    }
                    });

                    const profileImage2 = document.getElementById('post-image2');
                        const profilePhotoInput2 = document.getElementById('upload_profile_pic2');
                        profilePhotoInput2.addEventListener('change', function(event) {
                            const selectedFile = event.target.files[0];

                        if (selectedFile) {
                        const reader = new FileReader();

                        reader.onload = function() {
                      profileImage2.src = reader.result;
                        };

                    reader.readAsDataURL(selectedFile);
                    }
                    });
           