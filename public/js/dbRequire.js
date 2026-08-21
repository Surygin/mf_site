const newDiv = document.createElement('div');
const newDivSlider = document.createElement('div');
const helpBlock = document.querySelector('.help__block');
const alreadyHelped = document.querySelector('.already-helped');
document.body.appendChild(newDiv);
document.body.appendChild(newDivSlider);


function addLayoutKid() {
  fetch('admin/kids.php')
    .then((res) => {
      if (res.ok) {
        return res.json();
      }
    })
    .then((data) => {
      getKids(data);
      openModalKid(data);
      setOrders();
  })

}
addLayoutKid();

function getKids(data) {
  for (let i = 0; i < data.length; i++) {
    const newKid = document.createElement('div');
    newKid.classList.add('row')
    newKid.setAttribute('data-status',`${data[i].status}`)
    newKid.innerHTML = `
    <div class="help__kid-logo">
      <div class="help__item" >
        <img class="help_photo" src="${data[i].avatar}" alt="${data[i].name}">
        <div class="help__info">
          <p class="help__name">${data[i].name}</p>
          <p class="help__money d-flex flex-column">
            <span>Внесено пожертвований</span>
            <span>${data[i].sum1} рублей из</span>
            <span>${data[i].sum2} рублей </span>
          </p>
          <p><a class="help__link" href="#" data-user="${data[i].id}">История Маргариты</a></p>
        </div>
      </div>
    </div>
    <div class="help__kid-buttons">
      <div class="help__btn d-flex flex-column">
        <a class="main__btn" href="#">Сделать пожертвование</a>
        <a class="main__btn main__btn-reverse" href="#">Помочь другим способом</a>
        <a class="main__btn main__btn-reverse" href="#">Счет для Юридических лиц</a>
      </div>
    </div>
    `
    if (data[i].status === 'active') {
      helpBlock.appendChild(newKid);
    } else {
      alreadyHelped.appendChild(newKid);
    }
  }
}

function openModalKid(elem) {
  let userItem = document.querySelectorAll('.help__link');
    if (userItem.length > 0 ){
      for (let i = 0; i < userItem.length; i++) {
          let element = userItem[i]
          $(element).on('click',function (e) {
          e.preventDefault();
          const target = e.target.getAttribute('data-user')
          elem.forEach(function(elem) {
              if (elem.id === target) {
                addLayoutModal(elem.id, elem.name, elem.last_name, elem.avatar, elem.history)
            }
          })
        })
      }
    }
}

function addLayoutModal(id, name, secondName, image, history) {
  newDiv.innerHTML = `

  <section class="modal" id=${id}>
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="modal-window">
            <div class="modal-window__img">
              <img src="${image}" alt="Фото - ${secondName}">
            </div>
            <img class="modal__btn-close" src="img/header/close_btn.svg" alt="Закрыть окно">
            <div class="modal-window__text">
              <h2>${name} ${secondName}</h2>
              <p>
              ${history}
              </p>
              <button class="main__btn-modal">Фото и документы</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  `
  $(`.modal`).show(100);
}

function addSlide(doc) {
  const sliderItems = document.createElement('div');
  sliderItems.classList.add('docs');

  for (let i = 0; i < doc.length; i++) {
    const newDoc = document.createElement('div');
    const element = doc[i];
    newDoc.innerHTML =  `
    <div class="main-block"><img src="img/docs/${element}" alt="Документ"></img></div>
    `
    sliderItems.appendChild(newDoc)
  }

  return sliderItems;
}

function addLayoutSlider(id, docArray, kidsId) {
  newDiv.innerHTML = `
  <section class="modal-docs" id="${kidsId}">
  <div class="container">
      <div class="row">
          <div class="col-12">
              <div class="modal-docs-window">
                  <div class="modal-docs-window__img text-center">

                  </div>
                  <div class="modal-docs-window__text">
                      <img class="modal__btn-close" src="img/header/close_btn.svg" alt="Закрыть окно">
                  </div>
              </div>
          </div>
      </div>
  </div>
</section>
  `

  document.querySelector('.modal-docs-window__img.text-center').appendChild(addSlide(docArray))

  $(`.modal`).hide(100);
  $(`.modal-docs`).show(100);
  const doc = document.querySelector('.docs');
  startSlick(doc);
}


function setOrders() {
  const allActiveStatus = document.querySelectorAll('[data-status="active"]');
  const allFinishedStatus = document.querySelectorAll('[data-status="finished"]');
  for (let i = 0; i < allActiveStatus.length; i++) {
    const element = allActiveStatus[i];
    if (i % 2 === 0) {
      element.querySelector('.help__kid-logo').classList.add("col-md-8", "col-12");
      element.querySelector('.help__kid-logo').style.order = '0';
      element.querySelector('.help__kid-buttons').classList.add("col-md-4", "col-12");
      element.querySelector('.help__kid-buttons').style.order = '1';

    } else {
      element.classList.add("d-flex", "flex-md-row", "flex-column-reverse");
      element.querySelector('.help__kid-logo').classList.add("col-md-4", "col-12");
      element.querySelector('.help__kid-logo').style.order = '1';
      element.querySelector('.help__kid-buttons').classList.add("col-md-8", "col-12");
      element.querySelector('.help__kid-buttons').style.order = '0';
    }
  }

  for (let i = 0; i < allFinishedStatus.length; i++) {
    const element = allFinishedStatus[i];
    if (i % 2 === 0) {
      element.querySelector('.help__kid-logo').classList.add("col-md-8", "col-12");
      element.querySelector('.help__kid-logo').style.order = '0';
      element.querySelector('.help__kid-buttons').classList.add("col-md-4", "col-12");
      element.querySelector('.help__kid-buttons').style.order = '1';
    } else {
      element.classList.add("d-flex", "flex-md-row", "flex-column-reverse");
      element.querySelector('.help__kid-logo').classList.add("col-md-4", "col-12");
      element.querySelector('.help__kid-logo').style.order = '1';
      element.querySelector('.help__kid-buttons').classList.add("col-md-8", "col-12");
      element.querySelector('.help__kid-buttons').style.order = '0';
    }
  }
}

function startSlick(documents) {
    $(documents).slick({
      arrows: true,
      infinite: true,
      speed: 500,
      fade: true,
      cssEase: 'linear'
  });
}

function newArray(param, id) {
  const arrayDocs = [];
  const newArr = param;
  for (let i = 0; i < newArr.length; i++) {
    const element = newArr[i];
    if (element.kids_id == id) {
      arrayDocs.push(element.name)
    }
  }
  return arrayDocs;
}

function openSlider(modalId) {
  fetch('admin/kids2.php')
    .then((res) => {
      if (res.ok) {
        return res.json();
      }
    })
    .then((data) => {
      
      addLayoutSlider(data.id, newArray(data, modalId), data.kids_id)
  })
}





$('body').on('click', function (e) {
  const target = e.target
  if (target.classList.contains('modal__btn-close')) {
    $(`.modal`).hide(100);
    $(`.modal-docs`).hide(100);
  }
  if (target.classList.contains('main__btn-modal')) {
    const idModal = $('.modal')[0].id
    openSlider(idModal);
    
  }
})


//set up kids layout
