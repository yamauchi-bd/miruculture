<footer class="w-full py-16">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="mx-auto">
      <ul class="flex flex-wrap justify-center gap-4 sm:gap-6 lg:gap-8 text-xs sm:text-sm border-b border-gray-200 pb-8 mb-4">
        {{-- <li><a href="#" class="text-gray-500 hover:text-gray-900">運営会社</a></li> --}}
        <li><a href="{{ route('rule') }}" class="text-gray-500 hover:text-gray-900">利用規約</a></li>
        <li><a href="{{ route('policy') }}" class="text-gray-500 hover:text-gray-900">プライバシーポリシー</a></li>
        {{-- <li><a href="#" class="text-gray-500 hover:text-gray-900">利用ポリシー</a></li> --}}
        {{-- <li><a href="#" class="text-gray-500 hover:text-gray-900">投稿ガイドライン</a></li> --}}
        <li><a href="mailto:info@vivivision.jp" class="text-gray-500 hover:text-gray-900">報告•お問合せ</a></li>
      </ul>

      <span class="text-xs sm:text-sm text-gray-400 text-center block">
        ©<a href="{{ route('home') }}" class="hover:underline">vivivision</a> 2024, All rights reserved.
      </span>
    </div>
  </div>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/pagedone@1.1.2/src/js/pagedone.js"></script>
  @vite(['resources/js/top.js'])
</body>

</html>