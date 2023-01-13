<?php 

?>

<style>
    body.light {
      background: #d1dae3;
    }
  
    .clock {
      width: 300px;
      height: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
      background: #00092c url('../img/arbhie-clock.png');
      /* background: #00092c url('https://i.ibb.co/qkhDqVR/clock.png') */;  
      background-size: cover;
      border: 4px solid #00092c;
      box-shadow: -8px -8px 15px rgba(255, 255, 255, 0.05),
        20px 20px 20px rgba(0, 0, 0, 0.3),
        inset -8px -8px 15px rgba(255, 255, 255, 0.05),
        inset 20px 20px 20px rgba(0, 0, 0, 0.3);
      border-radius: 50%;
    }
  
    body.light .clock {
      /* background: #d1dae3 url('https://i.ibb.co/qkhDqVR/clock.png'); */
      background: #d1dae3 url('../img/arbhie-clock.png');
      background-size: cover;
      border: 4px solid #d1dae3;
      box-shadow: -8px -8px 15px rgba(255, 255, 255, 0.5),
        10px 10px 10px rgba(0, 0, 0, 0.1),
        inset -8px -8px 15px rgba(255, 255, 255, 0.5),
        inset 10px 10px 10px rgba(0, 0, 0, 0.1);
    }
  
    .clock::before {
      content: '';
      position: absolute;
      width: 15px;
      height: 15px;
      background: red;
      border-radius: 50%;
    }
  
    body.light .clock::before {
      background: #008eff;
    }
  
    .clock .hour,
    .clock .min,
    .clock .sec {
      position: absolute;
    }
  
    .clock .hour,
    .hr {
      width: 160px;
      height: 160px;
    }
  
    .clock .min,
    .mn {
      width: 190px;
      height: 190px;
    }
  
    .clock .sec,
    .sc {
      width: 230px;
      height: 230px;
    }
  
    .hr,
    .mn,
    .sc {
      display: flex;
      justify-content: center;
      position: absolute;
      border-radius: 50%;
    }
  
    .hr::before {
      content: '';
      position: absolute;
      width: 8px;
      height: 80px;
      background: #ff5f00;
      z-index: 10;
      border-radius: 6px 6px 0 0;
    }
  
    .mn::before {
      content: '';
      position: absolute;
      width: 5px;
      height: 90px;
      background: #000;
      z-index: 11;
      border-radius: 6px 6px 0 0;
    }
  
    body.light .mn::before {
      background: #00092c;
    }
  
    .sc::before {
      content: '';
      position: absolute;
      width: 2px;
      height: 150px;
      background: #19e4a0;
      z-index: 12;
      border-radius: 6px 6px 0 0;
    }
  
    .toggleClass {
      position: absolute;
      top: 30px;
      right: 150px;
      width: 20px;
      height: 20px;
      font-size: 18px;
      border-radius: 50%;
      background: #d1dae3;
      color: #d1dae3;
      font-family: courier;
      cursor: pointer;
      display: flex;
      align-items: center;
    }
  
    body.light .toggleClass {
      background: #091921;
      color: #091921;
    }
  
    .toggleClass::before {
      position: absolute;
      left: 25px;
      content: 'light Mode';
      white-space: nowrap;
      z-index: 1;
    }
  
    body.light .toggleClass::before {
      content: 'Dark mode';
    }
  
    .toggleClass::after {
      content: '';
      position: absolute;
      top: 0;
      transform: translateX(60%);
      left: 40%;
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background: #091921;
      transition: transform 0.5s;
    }
  
    body.light .toggleClass::after {
      background: #d1dae3;
      transform: translateX(0%);
    }
  </style>
  
  <div class="clock">
    <div class="hour">
      <div class="hr" id="hr"></div>
    </div>
    <div class="min">
      <div class="mn" id="mn"></div>
    </div>
    <div class="sec">
      <div class="sc" id="sc"></div>
    </div>
  </div>
  
  <script>
    const deg = 6;
    const hr = document.querySelector('#hr');
    const mn = document.querySelector('#mn');
    const sc = document.querySelector('#sc');
    setInterval(() => {
      let day = new Date();
      let hh = day.getHours() * 30;
      let mm = day.getMinutes() * deg;
      let ss = day.getSeconds() * deg;
      hr.style.transform = `rotateZ(${hh+(mm/12)}deg)`;
      mn.style.transform = `rotateZ(${mm}deg)`;
      sc.style.transform = `rotateZ(${ss}deg)`;
    })
  </script>