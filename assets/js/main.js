/*start api */
const errorLabel = document.querySelector("label[for='error-msg']")
const latInp = document.querySelector("#latitude")
const lonInp = document.querySelector("#longitude")
const airQuality = document.querySelector(".air-quality")
const airQualityStat = document.querySelector(".air-quality-status")
const srchBtn = document.querySelector(".search-btn")
const componentsEle = document.querySelectorAll(".component-val")

const appId = "3b30923d4600bf1e2f775c7d41b1a18f" // https://home.openweathermap.org/api_keys
const link = "http://103.168.165.46/server/node"	// API end point https://api.openweathermap.org/data/2.5/air_pollution

const getUserLocation = () => {
	// Get user Location
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(onPositionGathered, onPositionGatherError)
	} else {
		onPositionGatherError({ message: "Can't Access your location. Please enter your co-ordinates" })
	}
}

const onPositionGathered = (pos) => {
	let lat = pos.coords.latitude.toFixed(4), lon = pos.coords.longitude.toFixed(4)

	// Set values of Input for user to know
	latInp.value = lat
	lonInp.value = lon

	// Get Air data from weather API
	getAirQuality(lat, lon)
}

const getAirQuality = async (lat, lon) => {
	// Get data from api
	const rawData = await fetch(`${link}`, 
    {
      method: 'GET', // *GET, POST, PUT, DELETE, etc.
      headers: {
        'Content-Type': 'application/json',
        'Authorization': "bearer "+ 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VybmFtZSI6InZpZXdlciIsImluc3RpdHV0ZSI6ImF0cyIsImRlc2lnbmF0aW9uIjoiYWRtaW4iLCJpYXQiOjE2NjQ0NTUwMjJ9.KW_hXmb4ZLNCB1id8WXpZFWJsdGn4hFPUoVwyBM9bPA'
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
     
      /*body: JSON.stringify(data) // body data type must match "Content-Type" header*/
    }
    
  ).catch(err => {
		/*onPositionGatherError({ message: "Something went wrong. Check your internet conection." })*/
		console.log(err)
	})
	const airData = await rawData.json()
  console.log(airData)
  // for loop into airData array ex. airData[0]
  for(const obj in airData){
    var co2range =airData[obj].reading.co2;
    document.getElementById("co2").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.battery;
    document.getElementById("battery").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.datetime;
    document.getElementById("datetime").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.humidity;
    document.getElementById("humidity").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.pressure;
    document.getElementById("pressure").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.temperature;
    document.getElementById("temperature").innerHTML = co2range
    
  }
  for(const obj in airData){
    var co2range =airData[obj].reading.sublocation;
    document.getElementById("sublocation").innerHTML = co2range
    
  }
	setValuesOfAir(airData)
	setComponentsOfAir(airData)
}

const setValuesOfAir = airData => {
	const aqi = airData.list[0].main.aqi
	let airStat = "", color = ""

	// Set Air Quality Index
	airQuality.innerText = aqi

	// Set status of air quality

	switch (aqi) {
		case 1:
			airStat = "Good"
			color = "rgb(19, 201, 28)"
			break
			case 2:
				airStat = "Fair"
				color = "rgb(15, 134, 25)"
				break
			case 3:
				airStat = "Moderate"
				color = "rgb(201, 204, 13)"
				break
			case 4:
				airStat = "Poor"
				color = "rgb(204, 83, 13)"
				break
		case 5:
			airStat = "Very Poor"
			color = "rgb(204, 13, 13)"
			break
		default:
			airStat = "Unknown"
	}

	airQualityStat.innerText = airStat
	airQualityStat.style.color = color
}

const setComponentsOfAir = airData => {
	let components = {...airData.list[0].components}
	componentsEle.forEach(ele => {
		const attr = ele.getAttribute('data-comp')
		ele.innerText = components[attr] += " μg/m³"
	})
}

const onPositionGatherError = e => {
	errorLabel.innerText = e.message
}

srchBtn.addEventListener("click", () => {
	getAirQuality(parseFloat(latInp.value).toFixed(4), parseFloat(lonInp.value).toFixed(4))
})

getUserLocation()

/*end api */
(function() {
  "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    if (all) {
      select(el, all).forEach(e => e.addEventListener(type, listener))
    } else {
      select(el, all).addEventListener(type, listener)
    }
  }

  /**
   * Easy on scroll event listener 
   */
  const onscroll = (el, listener) => {
    el.addEventListener('scroll', listener)
  }

  /**
   * Sidebar toggle
   */
  if (select('.toggle-sidebar-btn')) {
    on('click', '.toggle-sidebar-btn', function(e) {
      select('body').classList.toggle('toggle-sidebar')
    })
  }

  /**
   * Search bar toggle
   */
  if (select('.search-bar-toggle')) {
    on('click', '.search-bar-toggle', function(e) {
      select('.search-bar').classList.toggle('search-bar-show')
    })
  }

  /**
   * Navbar links active state on scroll
   */
  let navbarlinks = select('#navbar .scrollto', true)
  const navbarlinksActive = () => {
    let position = window.scrollY + 200
    navbarlinks.forEach(navbarlink => {
      if (!navbarlink.hash) return
      let section = select(navbarlink.hash)
      if (!section) return
      if (position >= section.offsetTop && position <= (section.offsetTop + section.offsetHeight)) {
        navbarlink.classList.add('active')
      } else {
        navbarlink.classList.remove('active')
      }
    })
  }
  window.addEventListener('load', navbarlinksActive)
  onscroll(document, navbarlinksActive)

  /**
   * Toggle .header-scrolled class to #header when page is scrolled
   */
  let selectHeader = select('#header')
  if (selectHeader) {
    const headerScrolled = () => {
      if (window.scrollY > 100) {
        selectHeader.classList.add('header-scrolled')
      } else {
        selectHeader.classList.remove('header-scrolled')
      }
    }
    window.addEventListener('load', headerScrolled)
    onscroll(document, headerScrolled)
  }

  /**
   * Back to top button
   */
  let backtotop = select('.back-to-top')
  if (backtotop) {
    const toggleBacktotop = () => {
      if (window.scrollY > 100) {
        backtotop.classList.add('active')
      } else {
        backtotop.classList.remove('active')
      }
    }
    window.addEventListener('load', toggleBacktotop)
    onscroll(document, toggleBacktotop)
  }

  /**
   * Initiate tooltips
   */
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  })

  /**
   * Initiate quill editors
   */
  if (select('.quill-editor-default')) {
    new Quill('.quill-editor-default', {
      theme: 'snow'
    });
  }

  if (select('.quill-editor-bubble')) {
    new Quill('.quill-editor-bubble', {
      theme: 'bubble'
    });
  }

  if (select('.quill-editor-full')) {
    new Quill(".quill-editor-full", {
      modules: {
        toolbar: [
          [{
            font: []
          }, {
            size: []
          }],
          ["bold", "italic", "underline", "strike"],
          [{
              color: []
            },
            {
              background: []
            }
          ],
          [{
              script: "super"
            },
            {
              script: "sub"
            }
          ],
          [{
              list: "ordered"
            },
            {
              list: "bullet"
            },
            {
              indent: "-1"
            },
            {
              indent: "+1"
            }
          ],
          ["direction", {
            align: []
          }],
          ["link", "image", "video"],
          ["clean"]
        ]
      },
      theme: "snow"
    });
  }

  /**
   * Initiate TinyMCE Editor
   */
  const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

  tinymce.init({
    selector: 'textarea.tinymce-editor',
    plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
    editimage_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    toolbar_sticky: true,
    toolbar_sticky_offset: isSmallScreen ? 102 : 108,
    autosave_ask_before_unload: true,
    autosave_interval: '30s',
    autosave_prefix: '{path}{query}-{id}-',
    autosave_restore_when_empty: false,
    autosave_retention: '2m',
    image_advtab: true,
    link_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_list: [{
        title: 'My page 1',
        value: 'https://www.tiny.cloud'
      },
      {
        title: 'My page 2',
        value: 'http://www.moxiecode.com'
      }
    ],
    image_class_list: [{
        title: 'None',
        value: ''
      },
      {
        title: 'Some class',
        value: 'class-name'
      }
    ],
    importcss_append: true,
    file_picker_callback: (callback, value, meta) => {
      /* Provide file and text for the link dialog */
      if (meta.filetype === 'file') {
        callback('https://www.google.com/logos/google.jpg', {
          text: 'My text'
        });
      }

      /* Provide image and alt text for the image dialog */
      if (meta.filetype === 'image') {
        callback('https://www.google.com/logos/google.jpg', {
          alt: 'My alt text'
        });
      }

      /* Provide alternative source and posted for the media dialog */
      if (meta.filetype === 'media') {
        callback('movie.mp4', {
          source2: 'alt.ogg',
          poster: 'https://www.google.com/logos/google.jpg'
        });
      }
    },
    templates: [{
        title: 'New Table',
        description: 'creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
      },
      {
        title: 'Starting my story',
        description: 'A cure for writers block',
        content: 'Once upon a time...'
      },
      {
        title: 'New list with dates',
        description: 'New List with dates',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
      }
    ],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    height: 600,
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_class: 'mceNonEditable',
    toolbar_mode: 'sliding',
    contextmenu: 'link image table',
    skin: useDarkMode ? 'oxide-dark' : 'oxide',
    content_css: useDarkMode ? 'dark' : 'default',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });

  /**
   * Initiate Bootstrap validation check
   */
  var needsValidation = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(needsValidation)
    .forEach(function(form) {
      form.addEventListener('submit', function(event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })

  /**
   * Initiate Datatables
   */
  const datatables = select('.datatable', true)
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable);
  })

  /**
   * Autoresize echart charts
   */
  const mainContainer = select('#main');
  if (mainContainer) {
    setTimeout(() => {
      new ResizeObserver(function() {
        select('.echart', true).forEach(getEchart => {
          echarts.getInstanceByDom(getEchart).resize();
        })
      }).observe(mainContainer);
    }, 200);
  }
  
  /**
   * api fetch 1 open weather
   
  const errorLabel = document.querySelector("label[for='error-msg']")
  const latInp = document.querySelector("#latitude")
  const lonInp = document.querySelector("#longitude")
  const airQuality = document.querySelector(".air-quality")
  const airQualityStat = document.querySelector(".air-quality-status")
  const srchBtn = document.querySelector(".search-btn")
  const componentsEle = document.querySelectorAll(".component-val")

  const appId = "3b30923d4600bf1e2f775c7d41b1a18f" // Get your own API Key from https://home.openweathermap.org/api_keys
  const link = "https://api.openweathermap.org/data/2.5/air_pollution"	// API end point

  const getAirQuality = async (lat, lon) => {
    // Get data from api
    const rawData = await fetch(`${link}?lat=${lat}&lon=${lon}&appid=${appId}`).catch(err => {
      onPositionGatherError({ message: "Something went wrong. Check your internet conection." })
      console.log(err)
    })
    const airData = await rawData.json()
    setValuesOfAir(airData)
    setComponentsOfAir(airData)
  }
  */


 /*
 api 2
  const options = {
    method: 'GET',
    headers: {
      'X-RapidAPI-Key': '4c580fcd7amsh2376fa9107e362ap161302jsnd1bc07826270',
      'X-RapidAPI-Host': 'air-quality.p.rapidapi.com'
    }
  };
  
  fetch('https://air-quality.p.rapidapi.com/forecast/airquality?lat=35.779&lon=-78.638&hours=72', options)
    .then(response => response.json())
    .then(response => console.log(response))
    .catch(err => console.error(err));
    
    node.js
    
    const axios = require("axios");

    const options = {
      method: 'GET',
      url: 'https://air-quality.p.rapidapi.com/forecast/airquality',
      params: {lat: '35.779', lon: '-78.638', hours: '72'},
      headers: {
        'X-RapidAPI-Key': '4c580fcd7amsh2376fa9107e362ap161302jsnd1bc07826270',
        'X-RapidAPI-Host': 'air-quality.p.rapidapi.com'
      }
    };
    
    axios.request(options).then(function (response) {
      console.log(response.data);
    }).catch(function (error) {
      console.error(error);
    }); */

  /*api3
      const ul = document.getElementById('authors');
      const list = document.createDocumentFragment();
      const url = 'https://jsonplaceholder.typicode.com/users';
      
      fetch(url)
      .then((response) => {
      return response.json();
      })
      .then((data) => {
      let authors = data;
      
      authors.map(function(author) {
        let li = document.createElement('li');
        let name = document.createElement('h2');
        let email = document.createElement('span');

        name.innerHTML = `${author.name}`;
        email.innerHTML = `${author.email}`;

        li.appendChild(name);
        li.appendChild(email);
        list.appendChild(li);
      });
    }).
    .catch(function(error) {
      console.log(error);
    });

  ul.appendChild(list); */

/* APi3 rapid api
const options = {
	method: 'GET',
	headers: {
		'X-RapidAPI-Key': '4c580fcd7amsh2376fa9107e362ap161302jsnd1bc07826270',
		'X-RapidAPI-Host': 'air-quality-by-api-ninjas.p.rapidapi.com'
	}
};

fetch('https://air-quality-by-api-ninjas.p.rapidapi.com/v1/airquality?city=Seattle', options)
	.then(response => response.json())
	.then(response => console.log(response))
	.catch(err => console.error(err)); */


})();