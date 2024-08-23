<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href=" https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/css/pagedone.css ">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link href="https://unpkg.com/tailwindcss@0.3.0/dist/tailwind.min.css" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/script-name.js"></script>

  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          manrope: ["Manrope", "sans-serif"],
          inter: ["Inter", "serif"],
        },
      },
    };
  </script>
  <title>11_企業ページ</title>
</head>

<body>


  <nav class="py-5 lg:fixed transition-all top-0 left-0 z-50 duration-500 w-full bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="w-full flex flex-col lg:flex-row">
        <div class="flex justify-between lg:flex-row">
          <a href="
          https://pagedone.io/" class="flex items-center">
            <svg width="164" height="33" viewBox="0 0 164 33" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path
                d="M47 24.7231V7H54.4171C54.5916 7 54.816 7.00821 55.0903 7.02462C55.3645 7.03282 55.618 7.05744 55.8507 7.09846C56.8895 7.25436 57.7455 7.59487 58.4186 8.12C59.1001 8.64513 59.6029 9.30974 59.927 10.1138C60.2594 10.9097 60.4256 11.7959 60.4256 12.7723C60.4256 13.7405 60.2594 14.6267 59.927 15.4308C59.5945 16.2267 59.0876 16.8872 58.4061 17.4123C57.733 17.9374 56.8812 18.2779 55.8507 18.4338C55.618 18.4667 55.3604 18.4913 55.0778 18.5077C54.8035 18.5241 54.5833 18.5323 54.4171 18.5323H50.0042V24.7231H47ZM50.0042 15.7631H54.2925C54.4587 15.7631 54.6457 15.7549 54.8534 15.7385C55.0612 15.7221 55.2523 15.6892 55.4268 15.64C55.9255 15.5169 56.3161 15.2995 56.5986 14.9877C56.8895 14.6759 57.0931 14.3231 57.2094 13.9292C57.3341 13.5354 57.3964 13.1497 57.3964 12.7723C57.3964 12.3949 57.3341 12.0092 57.2094 11.6154C57.0931 11.2133 56.8895 10.8564 56.5986 10.5446C56.3161 10.2328 55.9255 10.0154 55.4268 9.89231C55.2523 9.84308 55.0612 9.81436 54.8534 9.80615C54.6457 9.78974 54.4587 9.78154 54.2925 9.78154H50.0042V15.7631Z"
                fill="#101828"></path>
              <path
                d="M66.0975 25.0923C65.1252 25.0923 64.3024 24.9118 63.6293 24.5508C62.9561 24.1815 62.445 23.6933 62.096 23.0862C61.7553 22.479 61.5849 21.8103 61.5849 21.08C61.5849 20.44 61.6929 19.8656 61.909 19.3569C62.1251 18.84 62.4575 18.3969 62.9063 18.0277C63.355 17.6503 63.9368 17.3426 64.6515 17.1046C65.1917 16.9323 65.8233 16.7764 66.5463 16.6369C67.2776 16.4974 68.0671 16.3703 68.9148 16.2554C69.7707 16.1323 70.6641 16.001 71.5949 15.8615L70.5228 16.4646C70.5311 15.5456 70.3234 14.8687 69.8995 14.4338C69.4757 13.999 68.761 13.7815 67.7554 13.7815C67.1488 13.7815 66.5629 13.921 65.9978 14.2C65.4327 14.479 65.0379 14.959 64.8135 15.64L62.0711 14.7908C62.4035 13.6667 63.0351 12.7641 63.9659 12.0831C64.9049 11.4021 66.1681 11.0615 67.7554 11.0615C68.9522 11.0615 70.0034 11.2544 70.9093 11.64C71.8234 12.0256 72.5007 12.6574 72.9412 13.5354C73.1822 14.0031 73.3276 14.4831 73.3775 14.9754C73.4274 15.4595 73.4523 15.9887 73.4523 16.5631V24.7231H70.822V21.8431L71.2583 22.3108C70.6517 23.2708 69.9411 23.9764 69.1267 24.4277C68.3206 24.8708 67.3108 25.0923 66.0975 25.0923ZM66.6959 22.7292C67.3773 22.7292 67.9591 22.6103 68.4411 22.3723C68.9231 22.1344 69.3054 21.8431 69.5879 21.4985C69.8788 21.1538 70.0741 20.8297 70.1738 20.5262C70.3317 20.1487 70.419 19.7179 70.4356 19.2338C70.4605 18.7415 70.473 18.3436 70.473 18.04L71.3954 18.3108C70.4896 18.4503 69.7126 18.5733 69.0643 18.68C68.4161 18.7867 67.8593 18.8892 67.3939 18.9877C66.9286 19.0779 66.5172 19.1805 66.1598 19.2954C65.8108 19.4185 65.5158 19.5621 65.2748 19.7262C65.0338 19.8903 64.8468 20.079 64.7138 20.2923C64.5891 20.5056 64.5268 20.7559 64.5268 21.0431C64.5268 21.3713 64.6099 21.6626 64.7761 21.9169C64.9423 22.1631 65.1833 22.36 65.4991 22.5077C65.8233 22.6554 66.2222 22.7292 66.6959 22.7292Z"
                fill="#101828"></path>
              <path
                d="M82.1078 31C81.3598 31 80.641 30.8851 79.9512 30.6554C79.2698 30.4256 78.6548 30.0933 78.1063 29.6585C77.5578 29.2318 77.109 28.7149 76.76 28.1077L79.5274 26.7538C79.785 27.2379 80.1465 27.5949 80.6119 27.8246C81.0856 28.0626 81.5884 28.1815 82.1203 28.1815C82.7435 28.1815 83.3003 28.0708 83.7907 27.8492C84.281 27.6359 84.6591 27.3159 84.925 26.8892C85.1993 26.4708 85.3281 25.9456 85.3115 25.3138V21.5354H85.6855V11.4308H88.3157V25.3631C88.3157 25.6995 88.2991 26.0195 88.2659 26.3231C88.2409 26.6349 88.1952 26.9385 88.1287 27.2338C87.9293 28.0954 87.547 28.801 86.9819 29.3508C86.4168 29.9087 85.7145 30.3231 84.8752 30.5938C84.0441 30.8646 83.1217 31 82.1078 31ZM81.846 25.0923C80.6077 25.0923 79.5274 24.7846 78.6049 24.1692C77.6825 23.5538 76.9678 22.7169 76.4608 21.6585C75.9539 20.6 75.7004 19.4062 75.7004 18.0769C75.7004 16.7313 75.9539 15.5333 76.4608 14.4831C76.9761 13.4246 77.7032 12.5918 78.6423 11.9846C79.5814 11.3692 80.6867 11.0615 81.9582 11.0615C83.238 11.0615 84.3101 11.3692 85.1744 11.9846C86.047 12.5918 86.7076 13.4246 87.1564 14.4831C87.6052 15.5415 87.8296 16.7395 87.8296 18.0769C87.8296 19.3979 87.6052 20.5918 87.1564 21.6585C86.7076 22.7169 86.0387 23.5538 85.1494 24.1692C84.2602 24.7846 83.1591 25.0923 81.846 25.0923ZM82.3072 22.4338C83.1134 22.4338 83.7616 22.2533 84.2519 21.8923C84.7505 21.5231 85.112 21.0103 85.3364 20.3538C85.5691 19.6974 85.6855 18.9385 85.6855 18.0769C85.6855 17.2072 85.5691 16.4482 85.3364 15.8C85.112 15.1436 84.7588 14.6349 84.2768 14.2738C83.7948 13.9046 83.1715 13.72 82.407 13.72C81.6008 13.72 80.936 13.9169 80.4124 14.3108C79.8889 14.6964 79.5024 15.2215 79.2531 15.8862C79.0038 16.5426 78.8792 17.2728 78.8792 18.0769C78.8792 18.8892 78.9997 19.6277 79.2407 20.2923C79.49 20.9487 79.8681 21.4697 80.375 21.8554C80.882 22.241 81.5261 22.4338 82.3072 22.4338Z"
                fill="#101828"></path>
              <path
                d="M97.6827 25.0923C96.3198 25.0923 95.1231 24.801 94.0926 24.2185C93.0621 23.6359 92.256 22.8277 91.6743 21.7938C91.1008 20.76 90.8141 19.5703 90.8141 18.2246C90.8141 16.7723 91.0967 15.5128 91.6618 14.4462C92.2269 13.3713 93.0122 12.5385 94.0178 11.9477C95.0234 11.3569 96.1869 11.0615 97.5082 11.0615C98.9044 11.0615 100.089 11.3856 101.061 12.0338C102.042 12.6738 102.769 13.5805 103.242 14.7538C103.716 15.9272 103.895 17.3097 103.778 18.9015H100.799V17.8185C100.791 16.3744 100.533 15.32 100.026 14.6554C99.5194 13.9908 98.7216 13.6585 97.6329 13.6585C96.4029 13.6585 95.4888 14.0359 94.8904 14.7908C94.2921 15.5374 93.9929 16.6328 93.9929 18.0769C93.9929 19.4226 94.2921 20.4646 94.8904 21.2031C95.4888 21.9415 96.3614 22.3108 97.5082 22.3108C98.2479 22.3108 98.8836 22.1508 99.4155 21.8308C99.9557 21.5026 100.371 21.0308 100.662 20.4154L103.629 21.3015C103.114 22.4995 102.316 23.4308 101.235 24.0954C100.163 24.76 98.9792 25.0923 97.6827 25.0923ZM93.0455 18.9015V16.6615H102.308V18.9015H93.0455Z"
                fill="#101828"></path>
              <path
                d="M111.708 25.0923C110.47 25.0923 109.39 24.7846 108.467 24.1692C107.545 23.5538 106.83 22.7169 106.323 21.6585C105.816 20.6 105.563 19.4062 105.563 18.0769C105.563 16.7313 105.816 15.5333 106.323 14.4831C106.838 13.4246 107.565 12.5918 108.505 11.9846C109.444 11.3692 110.549 11.0615 111.82 11.0615C113.1 11.0615 114.172 11.3692 115.037 11.9846C115.909 12.5918 116.57 13.4246 117.019 14.4831C117.467 15.5415 117.692 16.7395 117.692 18.0769C117.692 19.3979 117.467 20.5918 117.019 21.6585C116.57 22.7169 115.901 23.5538 115.012 24.1692C114.122 24.7846 113.021 25.0923 111.708 25.0923ZM112.169 22.4338C112.976 22.4338 113.624 22.2533 114.114 21.8923C114.613 21.5231 114.974 21.0103 115.199 20.3538C115.431 19.6974 115.548 18.9385 115.548 18.0769C115.548 17.2072 115.431 16.4482 115.199 15.8C114.974 15.1436 114.621 14.6349 114.139 14.2738C113.657 13.9046 113.034 13.72 112.269 13.72C111.463 13.72 110.798 13.9169 110.275 14.3108C109.751 14.6964 109.365 15.2215 109.115 15.8862C108.866 16.5426 108.741 17.2728 108.741 18.0769C108.741 18.8892 108.862 19.6277 109.103 20.2923C109.352 20.9487 109.73 21.4697 110.237 21.8554C110.744 22.241 111.388 22.4338 112.169 22.4338ZM115.548 24.7231V15.3938H115.174V7H118.203V24.7231H115.548Z"
                fill="#101828"></path>
              <path
                d="M127.395 25.0923C126.049 25.0923 124.873 24.7928 123.867 24.1938C122.861 23.5949 122.08 22.7703 121.523 21.72C120.975 20.6615 120.701 19.4472 120.701 18.0769C120.701 16.6821 120.983 15.4595 121.548 14.4092C122.113 13.359 122.899 12.5385 123.904 11.9477C124.91 11.3569 126.073 11.0615 127.395 11.0615C128.749 11.0615 129.93 11.361 130.935 11.96C131.941 12.559 132.722 13.3877 133.279 14.4462C133.835 15.4964 134.114 16.7067 134.114 18.0769C134.114 19.4554 133.831 20.6738 133.266 21.7323C132.709 22.7826 131.928 23.6072 130.923 24.2062C129.917 24.7969 128.741 25.0923 127.395 25.0923ZM127.395 22.3108C128.592 22.3108 129.481 21.9169 130.062 21.1292C130.644 20.3415 130.935 19.3241 130.935 18.0769C130.935 16.7887 130.64 15.7631 130.05 15C129.46 14.2287 128.575 13.8431 127.395 13.8431C126.589 13.8431 125.924 14.0236 125.4 14.3846C124.885 14.7374 124.503 15.2338 124.253 15.8738C124.004 16.5056 123.879 17.24 123.879 18.0769C123.879 19.3651 124.174 20.3949 124.765 21.1662C125.363 21.9292 126.24 22.3108 127.395 22.3108Z"
                fill="#101828"></path>
              <path
                d="M145.923 24.7231V18.3231C145.923 17.9046 145.894 17.441 145.836 16.9323C145.778 16.4236 145.64 15.9354 145.424 15.4677C145.217 14.9918 144.901 14.6021 144.477 14.2985C144.061 13.9949 143.496 13.8431 142.782 13.8431C142.399 13.8431 142.021 13.9046 141.647 14.0277C141.273 14.1508 140.933 14.3641 140.625 14.6677C140.326 14.9631 140.085 15.3733 139.902 15.8985C139.719 16.4154 139.628 17.08 139.628 17.8923L137.845 17.1415C137.845 16.0092 138.065 14.9836 138.506 14.0646C138.955 13.1456 139.611 12.4154 140.475 11.8738C141.34 11.3241 142.403 11.0492 143.667 11.0492C144.664 11.0492 145.487 11.2133 146.135 11.5415C146.783 11.8697 147.298 12.2882 147.681 12.7969C148.063 13.3056 148.345 13.8472 148.528 14.4215C148.711 14.9959 148.827 15.5415 148.877 16.0585C148.936 16.5672 148.965 16.9815 148.965 17.3015V24.7231H145.923ZM136.586 24.7231V11.4308H139.266V15.5538H139.628V24.7231H136.586Z"
                fill="#101828"></path>
              <path
                d="M157.87 25.0923C156.507 25.0923 155.31 24.801 154.28 24.2185C153.249 23.6359 152.443 22.8277 151.861 21.7938C151.288 20.76 151.001 19.5703 151.001 18.2246C151.001 16.7723 151.284 15.5128 151.849 14.4462C152.414 13.3713 153.199 12.5385 154.205 11.9477C155.21 11.3569 156.374 11.0615 157.695 11.0615C159.091 11.0615 160.276 11.3856 161.248 12.0338C162.229 12.6738 162.956 13.5805 163.43 14.7538C163.903 15.9272 164.082 17.3097 163.966 18.9015H160.986V17.8185C160.978 16.3744 160.72 15.32 160.213 14.6554C159.706 13.9908 158.909 13.6585 157.82 13.6585C156.59 13.6585 155.676 14.0359 155.078 14.7908C154.479 15.5374 154.18 16.6328 154.18 18.0769C154.18 19.4226 154.479 20.4646 155.078 21.2031C155.676 21.9415 156.548 22.3108 157.695 22.3108C158.435 22.3108 159.071 22.1508 159.603 21.8308C160.143 21.5026 160.558 21.0308 160.849 20.4154L163.816 21.3015C163.301 22.4995 162.503 23.4308 161.423 24.0954C160.351 24.76 159.166 25.0923 157.87 25.0923ZM153.233 18.9015V16.6615H162.495V18.9015H153.233Z"
                fill="#101828"></path>
              <path
                d="M24.5473 11.8941C25.1905 12.5063 25.2068 13.5149 24.5837 14.1468L18.7585 20.054C18.1354 20.686 17.1087 20.702 16.4654 20.0898C15.8222 19.4776 15.8059 18.469 16.429 17.8371L22.2542 11.9299C22.8773 11.2979 23.904 11.2819 24.5473 11.8941Z"
                fill="url(#paint0_linear_6727_44729-1)"></path>
              <path fill-rule="evenodd" clip-rule="evenodd"
                d="M0 4.54673C0 2.03564 2.07211 0 4.62819 0H21.5399V0.00124069C28.9908 0.0998525 35 6.06429 35 13.4075C35 20.8123 28.8897 26.8151 21.3523 26.8151C18.6648 26.8151 16.1587 26.052 14.0463 24.7342L6.58815 31.9057C4.13431 34.2652 0 32.5573 0 29.1841V4.54673ZM11.5194 22.7055C9.15709 20.295 7.70452 17.0179 7.70452 13.4075C7.70452 12.5277 8.43056 11.8144 9.32619 11.8144C10.2218 11.8144 10.9479 12.5277 10.9479 13.4075C10.9479 19.0526 15.6061 23.6288 21.3523 23.6288C27.0985 23.6288 31.7567 19.0526 31.7567 13.4075C31.7567 7.76248 27.0985 3.18626 21.3523 3.18626H4.62819C3.86336 3.18626 3.24334 3.79536 3.24334 4.54673V29.1841C3.24334 29.7351 3.91866 30.014 4.31948 29.6286L11.5194 22.7055Z"
                fill="url(#paint1_linear_6727_44729-1)"></path>
              <defs>
                <linearGradient id="paint0_linear_6727_44729-1" x1="31.5325" y1="2.21268" x2="1.00231" y2="33.2898"
                  gradientUnits="userSpaceOnUse">
                  <stop stop-color="#9038FF"></stop>
                  <stop offset="0.993738" stop-color="#5551FF"></stop>
                </linearGradient>
                <linearGradient id="paint1_linear_6727_44729-1" x1="31.5325" y1="2.21268" x2="1.00231" y2="33.2898"
                  gradientUnits="userSpaceOnUse">
                  <stop stop-color="#9038FF"></stop>
                  <stop offset="0.993738" stop-color="#5551FF"></stop>
                </linearGradient>
              </defs>
            </svg>
          </a>
          <button data-collapse-toggle="navbar" type="button"
            class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
            aria-controls="navbar-default" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
            </svg>
          </button>
        </div>
        <div class="hidden w-full lg:flex lg:pl-11 max-lg:mt-1 max-lg:h-screen max-lg:overflow-y-auto" id="navbar">
          <div
            class="flex lg:items-center w-full justify-end flex-col lg:flex-row gap-4 lg:w-max max-lg:gap-4 lg:ml-auto">
            <a href="javascript:;"
              class="nav-link mb-2 block lg:mr-6 md:mb-0 lg:text-left text-sm text-gray-500 font-semibold transition-all duration-500 hover:text-gray-900">新着データ</a>
            <button
              class="bg-indigo-50 text-indigo-600 rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 py-3 px-6 text-sm hover:bg-indigo-100">
              ユーザー登録
            </button>
            <button
              class="bg-indigo-600 text-white rounded-full cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 py-3 px-6 text-sm hover:bg-indigo-700">
              ログイン
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>



  <section class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="py-10 lg:py-16 flex flex-col justify-center gap-x-16 gap-y-5 xl:gap-28 lg:flex-row lg:justify-between mx-auto max-w-full">
        <div class="w-full lg:w-3/4">
                <section class="relative">
                  <div class="w-full lg:max-w-4xl max-md:px-3">
                    <h2 class="font-manrope font-semibold text-2xl leading-9 text-black mb-12">
                      アクセンチュア株式会社
                    </h2>
              
                    <p class="font-normal text-lg leading-8 text-gray-600 mb-8">
                        総合コンサルティング企業大手の外資系企業。 経営・業務・ITにおける支援を主な業務とし、業務委託事業も展開、IT技術者の多さで国内のコンサルティング業界トップクラス。
                    </p>
                            
                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">ミッション</h3>
                    <p class="font-normal text-lg leading-8 text-gray-600 mb-8">
                        総合コンサルティング企業大手の外資系企業。 経営・業務・ITにおける支援を主な業務とし、業務委託事業も展開、IT技術者の多さで国内のコンサルティング業界トップクラス。
                    </p>

                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">ビジョン</h3>
                    <p class="font-normal text-lg leading-8 text-gray-600 mb-8">
                        総合コンサルティング企業大手の外資系企業。 経営・業務・ITにおける支援を主な業務とし、業務委託事業も展開、IT技術者の多さで国内のコンサルティング業界トップクラス。
                    </p>

                    <h3 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">バリュー</h3>
                    <p class="font-normal text-lg leading-8 text-gray-600 mb-8">
                        総合コンサルティング企業大手の外資系企業。 経営・業務・ITにおける支援を主な業務とし、業務委託事業も展開、IT技術者の多さで国内のコンサルティング業界トップクラス。
                    </p>
                  </div>
                </section>


                <section class="py-12">
                  <div class="mx-auto max-w-7xl">
                    <h2 class="font-manrope font-semibold text-xl leading-9 text-black mb-2">企業名のデータ（xxx件）</h2>
                    <div class="accordion-group" data-accordion="default-accordion">
                      <div class="accordion border border-solid border-gray-300 p-4 rounded-xl transition duration-500 accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4 active" id="basic-heading-one-with-icon">
                        <button class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600" aria-controls="basic-collapse-one-with-icon">
                          <div>
                            <p><span class="font-bold">営業</span><span class="ml-3">新卒入社</span><span class="ml-3">退職済</span><span class="ml-3">在籍3年未満</span><span class="ml-3">男性</span><span class="ml-3">（回答日：2024年08月07日）</span></p>
                            <h3 class="font-bold text-left">入社の決め手：1位 ビジョン共感　2位 事業内容　3位 成長環境</h3>
                          </div>
                          <svg class="w-6 h-6 text-gray-900 transition duration-500 block accordion-active:text-indigo-600 accordion-active:hidden group-hover:text-indigo-600 origin-center" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12H18M12 18V6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                          <svg class="w-6 h-6 text-gray-900 transition duration-500 hidden accordion-active:text-indigo-600 accordion-active:block group-hover:text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12H18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </button>
                        <div id="basic-collapse-one-with-icon" class="accordion-content w-full overflow-hidden pr-4" aria-labelledby="basic-heading-one" style="max-height: 1000px;">
                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">1位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>

                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">2位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>

                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">2位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>

                          <div class="mt-4 w-full flex justify-between items-center">
                            <div class="flex items-center">
                              <a href="" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 ease-in-out rounded-xl shadow-[0px_1px_2px_0px_rgba(16,_24,_40,_0.05)] justify-center items-center flex">
                                <span class="px-2 py-px text-white text-base font-semibold leading-relaxed">回答者に質問する</span>
                              </a>
                              <div class="ml-4 flex items-center justify-center group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle"><path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/></svg>
                                <span class="ml-1">100</span>
                              </div>
                            </div>

                            <div class="flex items-center">
                              <a href="" class="w-5 h-5 flex items-center justify-center group">
                                <svg class="text-indigo-600 group-hover:text-indigo-800 transition-all duration-700 ease-in-out" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 18 18" fill="none">
                                    <path d="M1.62629 2.43257C3.64001 0.448687 6.82082 0.311339 8.99614 2.02053C11.1723 0.311339 14.3589 0.448687 16.3726 2.43257L16.3734 2.43334C18.5412 4.57611 18.5412 8.04382 16.3804 10.1867L16.378 10.1891L9.46309 16.9764C9.20352 17.2312 8.78765 17.2309 8.52844 16.9758L1.62629 10.1821C-0.542748 8.04516 -0.542748 4.56947 1.62629 2.43257Z" fill="currentColor"></path>
                                </svg>
                              </a><span class="ml-1">100</span>

                              <a href="#" class="ml-4 block text-gray-900 transition-all duration-500 hover:text-indigo-600 ">
                                <svg class="w-[1.688rem] h-[1.688rem]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                                  <path d="M11.3214 8.93666L16.4919 3.05566H15.2667L10.7772 8.16205L7.1914 3.05566H3.05566L8.47803 10.7774L3.05566 16.9446H4.28097L9.022 11.552L12.8088 16.9446H16.9446L11.3211 8.93666H11.3214ZM9.64322 10.8455L9.09382 10.0765L4.72246 3.95821H6.60445L10.1322 8.8959L10.6816 9.66481L15.2672 16.083H13.3852L9.64322 10.8458V10.8455Z" fill="currentColor"/>
                                </svg>
                              </a>
                              <a href="#" class="ml-2 block text-gray-900 transition-all duration-500 hover:text-indigo-600 ">
                                  <svg class="w-[0.938rem] h-[1.625rem]" viewBox="0 0 15 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M13.7926 14.4697L14.5174 9.86889H10.0528V6.87836C10.0528 5.62033 10.6761 4.39105 12.6692 4.39105H14.7275V0.473179C13.5289 0.282204 12.3177 0.178886 11.1037 0.164062C7.42917 0.164062 5.0302 2.37101 5.0302 6.36077V9.86889H0.957031V14.4697H5.0302V25.5979H10.0528V14.4697H13.7926Z" fill="currentColor"/>
                                  </svg>
                              </a>
                            </div>

                          </div>


                        </div>
                      </div>

                      <div class="accordion border border-solid border-gray-300 p-4 rounded-xl transition duration-500 accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4 active" id="basic-heading-one-with-icon">
                        <button class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600" aria-controls="basic-collapse-one-with-icon">
                          <div>
                            <p><span class="font-bold">営業</span><span class="ml-3">新卒入社</span><span class="ml-3">退職済</span><span class="ml-3">在籍3年未満</span><span class="ml-3">男性</span><span class="ml-3">（回答日：2024年08月07日）</span></p>
                            <h3 class="font-bold text-left">入社の決め手：1位 ビジョン共感　2位 事業内容　3位 成長環境</h3>
                          </div>
                          <svg class="w-6 h-6 text-gray-900 transition duration-500 block accordion-active:text-indigo-600 accordion-active:hidden group-hover:text-indigo-600 origin-center" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12H18M12 18V6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                          <svg class="w-6 h-6 text-gray-900 transition duration-500 hidden accordion-active:text-indigo-600 accordion-active:block group-hover:text-indigo-600" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 12H18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"></path>
                          </svg>
                        </button>
                        <div id="basic-collapse-one-with-icon" class="accordion-content w-full overflow-hidden pr-4" aria-labelledby="basic-heading-one">
                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">1位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>

                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">2位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>

                          <div class="mt-8">
                            <h4 class="text-lg font-bold text-left">2位 ビジョン共感</h4>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                            
                            <h5 class="font-bold text-left mt-4">ビジョン共感 の満足度 <span class='bg-amber-50 text-amber-600 text-xs font-medium mr-2 px-1.5 py-1 rounded-full'>非常に高い</span></h5>
                            <p class='text-base text-gray-600 leading-6'>To create an account, find the 'Sign up' or 'Create account' button, fill out the registration form with your personal information, and click 'Create account' or 'Sign up.' Verify your email address if needed, and then log in to start using the platform.</p>
                          </div>


                        </div>
                      </div>



                    </div>
                  </div>
                </section>



                <section class="py-12 lg:py-20 ">
                  <div class="flex mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <a href="#"
                      class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                      企業名のトップへ</a>
                    <a href="#"
                      class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                      決め手を回答する</a>
                    <a href="#"
                      class="border border-gray-300 shadow-sm rounded-full py-3.5 px-7 w-52 flex justify-center items-center text-gray-900 font-semibold mx-auto transition-all duration-300 hover:bg-gray-100">
                      企業をフォローする</a>
                  </div>
                </section>

        </div>




        <div class="w-full lg:w-1/4">
            <div>
                <a href="#" class='block py-3 px-7 text-base bg-indigo-500 text-white rounded-xl cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-700'>決め手を回答する</a>
                <a href="#" class='mt-4 block py-3 px-7 text-base border border-indigo-500 text-indigo-600 rounded-xl cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 hover:bg-indigo-700'>企業をフォローする</a>
            </div>
            
            <div class="mt-4 flex flex-col">
                <div class=" overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                      <div class="img w-full mb-2">
                        <img src="https://pagedone.io/asset/uploads/1702355938.png" alt="Blog tailwind page">
                      </div>
                        <div class="overflow-hidden border border-gray-300">
                            <table class=" min-w-full  rounded-xl">
                                <tbody class="divide-y divide-gray-300 ">
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">業界</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">URL</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">所在地</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">従業員数</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">設立年</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">資本金</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">代表者</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                    <tr>
                                        <th class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900 ">上場区分</th>
                                        <td class="p-2 whitespace-nowrap text-sm leading-6 font-medium text-gray-900"> 20010510 </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
                                          









  <footer class="w-full">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mx-auto">
        <ul
          class="text-sm flex items-center justify-center flex-col gap-7 md:flex-row md:gap-12 transition-all duration-500 py-10 mb-2 border-b border-gray-200">
          <li><a href="#" class="text-gray-500 hover:text-gray-900">運営会社</a></li>
          <li><a href="#" class=" text-gray-500 hover:text-gray-900">利用規約</a></li>
          <li><a href="#" class=" text-gray-500 hover:text-gray-900">プライバシーポリシー</a></li>
          <li><a href="#" class=" text-gray-500 hover:text-gray-900">利用ポリシー</a></li>
          <li><a href="#" class=" text-gray-500 hover:text-gray-900">投稿ガイドライン</a></li>
          <li><a href="#" class=" text-gray-500 hover:text-gray-900">報告•お問合せ</a></li>
        </ul>
        
        <span class="text-sm text-gray-400 text-center block my-4">©<a href="https://pagedone.io/">vivivision</a> 2024, All
          rights reserved.</span>
      </div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
</body>

</html>