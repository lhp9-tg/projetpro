const track = document.querySelector('.track');
document.querySelector('.prev').addEventListener('click', (e)=>{
  track.append(track.querySelector('.item:first-of-type'));
});

document.querySelector('.next').addEventListener('click', (e)=>{
  track.prepend(track.querySelector('.item:last-of-type'));
});