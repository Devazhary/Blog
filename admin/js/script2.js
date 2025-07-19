const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('imagePreview');

imageInput.addEventListener('change', function () {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = function (e) {
      // Replace preview content with image
      imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
    };
    reader.readAsDataURL(file);
  } else {
    imagePreview.innerHTML = '<span>No image chosen</span>';
  }
});
