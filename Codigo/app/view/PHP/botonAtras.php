
  <style>
    
    
    .button {
      
      position: relative;
      background-color: white;
      width: 12rem; /* 48px * 4 */
      height: 3.5rem; /* 14px * 4 */
      border-radius: 1rem;
      font-size: 1.25rem; /* 20px */
      font-weight: 600;
      color: black;
      text-align: center;
      border: none;
      cursor: pointer;
      overflow: hidden;
      
    }

    .button .hover-effect {
      position: absolute;
      background-color:rgb(104, 86, 52); 
      height: 3rem; /* 12px * 4 */
      width: 25%; /* 1/4 */
      border-radius: 0.75rem;
      display: flex;
      align-items: center;
      justify-content: center;
      top: 0.25rem; /* 4px */
      left: 0.25rem; /* 4px */
      transition: width 0.5s ease;
      z-index: 10;
    }

    .button:hover .hover-effect {
      width: 11.5rem; /* Almost full width */
    }

    .button p {
      position: relative;
      z-index: 20;
      margin: 0;
      padding-left: 0.5rem; /* Translate x */
      transition: opacity 0.5s ease; /* Smooth fade effect */
    }

    .button:hover p {
      opacity: 0; /* Text disappears on hover */
    }

    .button svg {
      height: 25px;
      width: 25px;
    }
  </style>


<!-- Sacado de https://uiverse.io/AKAspidey01/orange-donkey-78 -->


<div class="alinear">

<button class="button" type="button">
    <div class="hover-effect">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 1024 1024"
        height="25px"
        width="25px"
      >
        <path
          d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
          fill="#000000"
        ></path>
        <path
          d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
          fill="#000000"
        ></path>
      </svg>
    </div>
    <p>Atrás</p>
  </button>
</div>


