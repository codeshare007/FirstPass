<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
   <head>
      @includeWhen(config('app.GOOGLE_ANALYTICS'), 'core::partials.google-analytics')
      <meta charset="UTF-8">
      <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta http-equiv="Content-Language" content="{{ app()->getLocale() }}"/>
      <meta name="msapplication-TileColor" content="#2d89ef">
      <meta name="theme-color" content="#4188c9">
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
      <meta name="apple-mobile-web-app-capable" content="yes">
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="HandheldFriendly" content="True">
      <meta name="MobileOptimized" content="320">
      <link rel="shortcut icon" type="image/x-icon" href="{{ Storage::url(config('app.logo_favicon'))}}"/>
      <title>@yield('title', config('app.name'))</title>
      <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet">
      <link rel="stylesheet" href="{{ Module::asset('landingpage:css/builder.css') }}">
      <link rel="stylesheet" href="{{ Module::asset('landingpage:css/customize.css') }}">

      <script src="{{ Module::asset('landingpage:js/builder.js') }}"></script>

      <script src="{{ Module::asset('landingpage:js/ckeditor/ckeditor.js') }}"></script>
      <script src="{{ Module::asset('landingpage:js/dist/grapesjs-plugin-ckeditor.min.js') }}"></script>

      <script src="https://grapesjs.com/js/grapesjs-plugin-forms.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>
      <script type="text/javascript">
         var config = {
           enable_edit_code: false,
           enable_slider: true,
           enable_countdown: true,
           enable_custom_code_block: true,
           url_get_products: "{{ URL::to('ecommerce/products/getproducts') }}",
           all_icons: @json($all_icons)
         }
      </script>
      <script src="{{ Module::asset('landingpage:js/grapeweb.js') }}"></script>
      <script src="{{ Module::asset('landingpage:js/grapesjs-plugin-export.min.js') }}"></script>
      <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
      <link href="https://unpkg.com/grapesjs-rte-extensions/dist/grapesjs-rte-extensions.min.css" rel="stylesheet">
      <script src="https://unpkg.com/grapesjs-rte-extensions"></script>

      <style>

         * {
         box-sizing: border-box;
         }
         html, body, [data-gjs-type=wrapper] {
         min-height: 100%;
         }
         body {
         margin: 0;
         height: 100%;
         background-color: #fff
         }
         [data-gjs-type=wrapper] {
         overflow: auto;
         overflow-x: hidden;
         }
         * ::-webkit-scrollbar-track {
         background: rgba(0, 0, 0, 0.1)
         }
         * ::-webkit-scrollbar-thumb {
         background: rgba(255, 255, 255, 0.2)
         }
         * ::-webkit-scrollbar {
         width: 10px
         }
         .gjs-dashed *[data-highlightable] {
         outline: 1px dashed rgba(170,170,170,0.7);
         outline-offset: -2px;
         }
         .gjs-selected {
         outline: 3px solid #3b97e3;
         outline-offset: -3px;
         }
         .gjs-selected-parent {
         outline: 2px solid #ffca6f !important
         }
         .gjs-no-select {
         user-select: none;
         -webkit-user-select:none;
         -moz-user-select: none;
         }
         .gjs-freezed {
         opacity: 0.5;
         pointer-events: none;
         }
         .gjs-no-pointer {
         pointer-events: none;
         }
         .gjs-plh-image {
         background: #f5f5f5;
         border: none;
         height: 100px;
         width: 100px;
         display: block;
         outline: 3px solid #ffca6f;
         cursor: pointer;
         outline-offset: -2px
         }
         .gjs-grabbing {
         cursor: grabbing;
         cursor: -webkit-grabbing;
         }
         .gjs-is__grabbing {
         overflow-x: hidden;
         }
         .gjs-is__grabbing,
         .gjs-is__grabbing * {
         cursor: grabbing !important;
         }
         * { box-sizing: border-box; } body {margin: 0;}
         .social-thumb img {
            width: 44px;
         }
         body {
         overflow: hidden;
         }
         :root {
         --sidebar-width: 60px;
         --sidebar-content-width: 300px;
         --sidebar-icon-size: 24px;
         --sidebar-icon-margin: 20px;
         --sidebar-background-color: #303030;
         --sidebar-active-color: #ffd05c;
         }
         .sidebar {
         position: absolute;
         z-index: 1000;
         top: 0;
         left: 0;
         background: var(--sidebar-background-color);
         max-width: var(--sidebar-width);
         width: 100%;
         height: 100vh;
         }
         .sidebar .sidebar-logo {
         width: 36px;
         height: 36px;
         background-image: url('{{ Storage::url(config('app.logo_favicon'))}}');
         background-repeat: no-repeat;
         background-size: contain;
         display: block;
         position: absolute;
         bottom: 0;
         margin: 10px 12px;
         }
         .sidebar hr {
         margin: 0 10px;
         }
         .sidebar .sidebar-item {
         position: relative;
         display: block;
         margin: var(--sidebar-icon-margin) auto;
         text-align: center;
         }
         .sidebar .sidebar-item .fas {
         color: white;
         font-size: var(--sidebar-icon-size);
         cursor: pointer;
         }
         .sidebar .sidebar-item__text {
         font-size: 10px;
         color: #fff;
         cursor: pointer;
         line-height: 1.4;
         margin-top: 2px;
         }
         .sidebar .sidebar-item.active .fas,
         .sidebar .sidebar-item:hover .fas,
         #backBtn:hover .fas,
         .sidebar .sidebar-item:hover .sidebar-item__text,
         .sidebar .sidebar-item.active .sidebar-item__text
         {
         color: var(--sidebar-active-color);
         }
         .sidebar-content-wrap .sidebar-content {
         position: absolute;
         top: 39px;
         left: -240px;
         width: var(--sidebar-content-width);
         height: calc(100vh - 39px);
         background: #3e3e3e;
         display: block;
         overflow: scroll;
         z-index: 1;
         }
         #backBtn {
         width: 100%;
         margin: var(--sidebar-icon-margin) auto;
         }
         #gjs {
         margin-left: var(--sidebar-width);
         width: calc(100% - var(--sidebar-width)) !important;
         }
         .gjs-block-category .gjs-title {
         font-size:15px;
         }
         .btn-page-group a[data-id] {
         color: #fff;
         display: inline-block;
         margin: 0 5px;
         float: right;
         }
         .btn-page-group i {
         pointer-events: none;
         }
         .page_block.active {
         background-color: #565B69;
         }
         .custom-btn {
         height: 50px;
         color: #000;
         background-color: #fdc231;
         cursor: pointer;
         display: flex;
         justify-content: center;
         align-items: center;
         }
         .custom-btn .fas {
         margin-right: 10px;
         }
         .gjs-cv-canvas {
         width: 100%;
         }
         .gjs-pn-views-container {
         right: -18%;
         }
         .export-all {
         width: var(--sidebar-content-width);
         text-decoration: none;
         position: relative;
         bottom: 0;

         }
         .add-page {
         margin-bottom: 10px;
         cursor: pointer;
         }
         .sidebar-content,
         .gjs-pn-views-container,
         .gjs-cv-canvas {
         transition: .08s;
         }
         .gjs-pn-views-container {
         top: 40px;
         padding: 0;
         }
         .gjs-pn-views {
         width: auto;
         border: none;
         display: none;
         }
         .gjs-pn-options {
         right: 0;
         }
         .option-btn {
         border: 1px solid #ffffff8c;
         border-radius: 5px;
         font-size: 14px;
         padding: 2px 5px;
         margin: 0 4px;
         cursor: pointer;
         min-width:75px;
         }
         .option-btn:hover {
         color: #fdc231;
         }
         #foreColor-picker,#hilite-picker { height: 250px;overflow: auto;}
         .rte-color-picker>div { width: 20px;height: 20px;}
         .gjs-trt-trait__wrp-action, .gjs-trt-trait__wrp-action .gjs-label{display: none}

      </style>
   </head>
   <body>
      <div id="mobileAlert">
         <div class="message">
            <h3>@lang('Builder not work on mobile')</h3>
            <a href="{{ route('landingpages.index') }}">@lang('Back')</a>
         </div>
      </div>
      <input type="text" name="code" value="{{$page->code}}" hidden class="form-control">
      <div id="loadingMessage">
         <div class="lds-ring">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
         </div>
      </div>

      <div class="sidebar">
         <a id="backBtn" href="/landingpages">
            <div class="sidebar-item">
               <i class="fas fa-arrow-left"></i>
            </div>
         </a>
         <hr>
         <div class="sidebar-item" data-name="sections">
            <i class="fas fa-cube"></i>
            <div class="sidebar-item__text">KRANE<br>ブロック</div>
         </div>
         <div class="sidebar-item" data-name="rows">
            <i class="fas fa-puzzle-piece"></i>
            <div class="sidebar-item__text">インライン<br>パーツ</div>
         </div>
         <div class="sidebar-item" data-name="pages">
            <i class="fas fa-copy"></i>
            <div class="sidebar-item__text">ページ</div>
         </div>
         <div class="sidebar-item" data-name="layer">
            <i class="fas fa-layer-group"></i>
            <div class="sidebar-item__text">レイヤー</div>
         </div>
         <a href="/landingpages">
            <div class="sidebar-logo"></div>
         </a>
      </div>
      <div class="sidebar-content-wrap">
         <div class="sidebar-content" id="sections" data-name="sections"></div>
         <div class="sidebar-content" id="rows" data-name="rows"></div>
         <div class="sidebar-content" id="pages" data-name="pages">
            <div class="head-block">
               <i class="far fa-file-alt"></i> ページ
            </div>
            <div class="btn-page-group">
               <div class="page_block {{ !request()->route('type') && request()->segment(3) == $main->code ? 'active' : '' }}"
                  data-id="{{ $main->id }}"
                  data-order="{{ $main->order }}"
                  >
                  <i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i>
                  <a href="{{ URL::to('landingpages/builder/'.$main->code)}}"
                     class="btn btn-link"
                     id="btn-main-page">TOPページ</a>
                  <!-- <i class="fas fa-ellipsis-h"></i> -->
                  <div class="builder_drop">
                     <div class="dropdown-container builder" tabindex="-1">
                        <div class="deep"><i class="fas fa-ellipsis-h"></i></div>
                        <div class="dropdown builder">
                           <a href="#" class="add-subpage" data-id="{{ $main->id }}">
                              <div><i class="far fa-copy"></i> 複製</div>
                           </a>
                        </div>
                     </div>
                  </div>

                  <!-- <a href="#" class="add-subpage" data-id="{{ $main->id }}"><i class="far fa-copy"></i></a> -->
               </div>
               <div class='edit-page'></div>
               @foreach($subpages as $key => $subpage)
               <div class="page_block {{ request()->segment(3) == $subpage->code ? 'active' : '' }}"
                  data-id="{{ $subpage->id }}"
                  data-order="{{ $subpage->order }}"
                  >
                  <i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i>
                  <a href="{{ URL::to("landingpages/builder/{$subpage->code}") }}"
                  class="btn btn-link"
                  >{{ $subpage->name }}</a>
                  <div class="builder_drop">
                     <div class="dropdown-container builder" tabindex="-1">
                        <div class="deep"><i class="fas fa-ellipsis-h"></i></div>
                        <div class="dropdown builder">
                           <!-- <a href="#" class="add-subpage" data-id="{{ $main->id }}"><div><i class="far fa-copy"></i> Dupliate</div> </a> -->
                           <a href="#" class="delete-subpage" data-id="{{ $subpage->id }}"><i class="far fa-trash-alt"></i> &nbsp; 削除</a><br>
                           <a href="#" class="rename-subpage" data-key="{{ $key }}" data-id="{{ $subpage->id }}"
                              data-name="{{ $subpage->name }}"><i class="far fa-edit"></i> &nbsp;ページ設定</a><br>
                           <a href="#" class="copy-subpage" data-id="{{ $subpage->id }}"><i class="far fa-copy"></i> &nbsp; 複製</a>

                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               <div class="builder_drop22" >
               <div class="dropdown-container" tabindex="10">
                  <div class="deep"><i class="fas fa-ellipsis-h"></i></div>
                     <div class="dropdown22">
                        <form class="form-custom" method="post" action="/landingpages/update-subpage" enctype="multipart/form-data" id="seo_details">
                           @csrf
                           <div class="form-group">
                              <input type="hidden" id="id" name="id">
                              <label>ページ名</label> <button onclick="closeit();" class='page-closing-button'> <i class="fas fa-times" id="time_icon"></i></button><br>
                              <input type="text" name="page_name" class="form-control" id="page_name" aria-describedby="emailHelp"><br>
                              <label>スラッグ名</label><br>
                              <input type="text" name="slug_name" class="form-control" id="slug_name" aria-describedby="emailHelp"><br>
                              <label>SEOタイトル</label><br>
                              <input type="text" name="seo_title" class="form-control" id="seo_title" aria-describedby="emailHelp"><br>
                              <label>SEOキーワード</label><br>
                              <input type="text" name="seo_keywords" class="form-control" id="seo_keywords" aria-describedby="emailHelp"><br>
                              <label>SEOディスクリプション</label><br>
                              <input type="text" name="seo_descriptions" class="form-control" id="seo_descriptions" aria-describedby="emailHelp"><br>
                              <label>OGPタイトル</label><br>
                              <input type="text" name="social_title" class="form-control" id="social_title" aria-describedby="emailHelp"><br>
                              <label>OGPディスクリプション</label><br>
                              <input type="text" name="social_description" class="form-control" id="social_description" aria-describedby="emailHelp"><br>
                              <label>OGP画像</label><br>
                              <input type="file" name="social_image" class="btn btn-secondary" value='Select Files'/>
                              <div class="social-thumb">
                                 <img src="" class="social-img" alt="">
                              </div>
                              <textarea class="form-control" name="custom_head" id="custom_head" placeholder="Include in <head> " rows="3"></textarea>
                              <textarea class="form-control" name="custom_body" id="custom_body" placeholder="Include in <body> top" rows="3"></textarea>

                              <button type="button" class="btn btn-warning btn-seo-details">保存</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
            <div class="page_block  add-page"><i class="fas fa-plus"></i>ページを追加</div>
            <a href="{{ route('landingpages.export-all', [$main->id]) }}"
               class="custom-btn export-all"><i class="fas fa-file-export"></i>エクスポート</a>
         </div>
         <div class="sidebar-content" id="layer" data-name="layer"></div>
      </div>

      <script>
         document.addEventListener('DOMContentLoaded', () => {
           const options = document.querySelector('.gjs-pn-options .gjs-pn-buttons')
           const expandBtn = options.querySelector('.fa-expand')
           const expandChange = () => expandBtn.classList.replace('fa-expand', 'fa-expand-alt')
           expandChange()
           expandBtn.addEventListener('click', expandChange)
           const publishBtn = options.querySelector('.fa-rocket')
           const publishChange = () => {
             publishBtn.classList = ['option-btn']
             publishBtn.innerHTML = 'サイト設定'
           }
           publishChange()
           publishBtn.addEventListener('click', publishChange)
           const saveBtn = options.querySelector('.fa-save')
           const saveChange = () => {
             saveBtn.classList = ['option-btn']
             saveBtn.innerHTML = '保存'
           }
           saveChange()
           saveBtn.addEventListener('click', saveChange)
           options.querySelector('.fa-redo').after(
             options.querySelector('.fa-expand-alt'),
             options.querySelector('.fa-square'),
             options.querySelector('.fa-eye'),
           )
         })
         document.querySelectorAll('.sidebar-item').forEach(el => {
           el.addEventListener('click', function () {
             document.querySelectorAll('.sidebar-content').forEach(el => el.style.left = '-240px')
             const sidebarContent = document.querySelector(`.sidebar-content[data-name="${this.dataset.name}"]`)
             const canvas = document.querySelector('.gjs-cv-canvas')
             const rightSidebarActive = document.querySelector('.gjs-pn-btn.fa-cog').classList.contains('gjs-pn-active')
             const hidden = this.classList.toggle('active') && sidebarContent.style.left !== '60px'
             if (hidden) {
               canvas.style.left = '300px'
               if (rightSidebarActive) {
                 document.querySelector('.gjs-pn-btn.fa-cog').click()
               }
               canvas.style.width = 'calc(100% - 300px)'
               sidebarContent.style.left = '60px'
             } else {
               canvas.style.left = 0

               canvas.style.width = '100%'

               sidebarContent.style.left = '-240px'
             }
           })
         })
         document.addEventListener('mouseup', e => {
           const sidebar = document.querySelector('.sidebar')
           const activeItem = document.querySelector('.sidebar-item.active')
           if (sidebar.isEqualNode(e.target) || document.querySelector('.sidebar-content-wrap').contains(e.target)
             || !activeItem || activeItem.contains(e.target)) {
             return
           }
           activeItem.classList.toggle('active')
           document.querySelectorAll('.sidebar-content').forEach(el => el.style.left = '-240px')
           const canvas = document.querySelector('.gjs-cv-canvas')
           canvas.style.width = '100%'
           canvas.style.left = 0
         })
         document.querySelector('.btn-page-group').addEventListener('click', async function (e) {
           if (e.target.classList.contains('add-subpage')) {
             e.preventDefault()
             const res = await fetch(`/landingpages/add-subpage/${e.target.dataset.id}`)
             const subpage = await res.json()
             appendSubpageItem(subpage)
           } else if (e.target.classList.contains('copy-subpage')) {
             e.preventDefault()
             const res = await fetch(`/landingpages/copy-subpage/${e.target.dataset.id}`)
             const copy = await res.json()
             appendSubpageItem(copy)
           }
         //   else if (e.target.classList.contains('rename-subpage')) {
         //    $(".builder_drop22").toggle();
         //     e.preventDefault()
         //     const _token = window._token
         //     const id = e.target.dataset.id
         //     const name = prompt('Rename the page', e.target.dataset.name)
         //     await fetch('/landingpages/rename-subpage', {
         //       method: 'POST',
         //       headers: {
         //         'Content-Type': 'application/json',
         //       },
         //       body: JSON.stringify({
         //         _token,
         //         id,
         //         name,
         //       }),
         //     })
         //     e.target.parentNode.querySelector('.btn').textContent = name
         //   }
           else if (e.target.classList.contains('delete-subpage')) {
             e.preventDefault()
             await fetch(`/landingpages/delete-subpage/${e.target.dataset.id}`)
            //  e.target.parentNode.remove()

             $('div.page_block[data-id="'+ e.target.dataset.id +'"]').remove();
           }
         })
         document.querySelector('.add-page').addEventListener('click', async function () {
           const res = await fetch(`/landingpages/add-empty-subpage/${pageId}`, {
               headers : {
               'Content-Type': 'application/json',
               'Accept': 'application/json'
               }

            })
           const subpage = await res.json()
           console.log(subpage);
           appendSubpageItem(subpage)
         })
         Sortable.create(document.querySelector('.btn-page-group'), {
           draggable: '.page_block',
           onUpdate: reorderSubpages,
         })
         function reorderSubpages () {
           document.querySelectorAll('.page_block').forEach((subpage, order) => {
             fetch('/landingpages/reorder-subpage', {
               method: 'POST',
               headers: {
                 'Content-Type': 'application/json',
               },
               body: JSON.stringify({
                 _token: window._token,
                 id: subpage.dataset.id,
                 order: order,
                 type: subpage.dataset.type,
               }),
             })
           })
         }
         (function renderOrderedSubpages () {
           const wrapper = document.querySelector('.btn-page-group')
           const subpages = [...wrapper.children].sort((a, b) => a.dataset.order - b.dataset.order)
           subpages.forEach(subpage => wrapper.appendChild(subpage))
         })()
         function appendSubpageItem (subpage) {
           const subpageEl = document.createElement('div')
           subpageEl.className = 'page_block'
           subpageEl.dataset.id = subpage.id
           subpageEl.innerHTML = `
           <i class="fas fa-ellipsis-v"></i><i class="fas fa-ellipsis-v"></i>
<a href="/landingpages/builder/${subpage.code}" class="btn btn-link">${subpage.name}</a>
<div class="dropdown-container builder" tabindex="-1">
    <div class="deep"><i class="fas fa-ellipsis-h"></i></div>
    <div class="dropdown builder">
        <a href="#" class="delete-subpage" data-id="${subpage.id}"><i class="far fa-trash-alt"></i> &nbsp;
            Delete</a><br>
        <a href="#" class="rename-subpage" data-key="" data-id="${subpage.id}"
            data-name="${subpage.name}"><i class="far fa-edit"></i> &nbsp;Edit Settings</a><br>
        <a href="#" class="copy-subpage" data-id="${subpage.id}"><i class="far fa-copy"></i> &nbsp; Duplicate</a>
    </div>
</div>
                 `
           document.querySelector('.btn-page-group').appendChild(subpageEl)
           reorderSubpages()
         }
      </script>

      <div id="gjs"></div>
      <div id="xyz"></div>
      @php
      $arr_blocks = [];
      foreach ($blocks as $item) {
      $arr_temp = [];
      $arr_temp['id'] = $item->id;
      $arr_temp['thumb'] = URL::to('/').'/storage/thumb_blocks/'.$item->thumb;
      $arr_temp['name'] = $item->name;
      $arr_temp['category'] = $item->category->name;
      $arr_temp['content'] = $item->getReplaceVarBlockContent();
      array_push($arr_blocks, $arr_temp);
      }
      @endphp
      <script type="text/javascript">
         const type_page = '{{request()->route('type')}}'
         var urlStore = '{{ URL::to('landingpages/update-builder/'.$page->code.'/'.request()->route('type')) }}'
         var urlLoad = '{{ URL::to('landingpages/load-builder/'.$page->code.'/'.request()->route('type')) }}'
         console.log(urlLoad);
         var upload_Image = '{{ URL::to('uploadimage') }}'
         var url_default_css_template = '{{Module::asset('landingpage:css/template.css')}}'
         var back_button_url = "{{ URL::to('landingpages') }}"
         var publish_button_url = '{{ URL::to('landingpages/setting/'.$page->code) }}'
         var url_delete_image = '{{ URL::to('/deleteimage') }}'
         var url_search_icon = '{{ URL::to('/searchIcon') }}'
         var _token = '{{ csrf_token() }}'
         var images_url = @json($images_url);
         let test=1;
         var blocksjs = @json($blocksjs);
         var blockscss = @json($blockscss);

         var blocks = @json($arr_blocks);
         var pageId = {{ $page->id }};
         var shareLink = '{{ $page->share_link ? url('/s/' . $page->share_link) : '' }}'
         var enableCloning = {{ $page->cloning }};
         var shareAllPages = {{ $page->share_all }};
      </script>
      <script src="{{ Module::asset('landingpage:js/customize-builder.js') }}"></script>
      <script>
         function closeit(){
            $(".builder_drop22").hide();
         }

         $(".btn-seo-details").click(function(){
            $("#seo_details").submit();
         });
         $(document).on('click', ".rename-subpage" , function(e) {
            e.preventDefault()
            $(".builder_drop22").toggle();
             const _token = window._token
             const id = e.target.dataset.id
             const name = e.target.dataset.name
             const response = fetch(`/landingpages/get-subpage/`+$(this).attr("data-id"))

            .then((response) => {
               return response.json();
            })
            .then((myJson) => {
               console.log("custom_head" + myJson.result.custom_head);
               $('#id').val(myJson.result.id);
               $('#page_name').val(myJson.result.name);
               $('#slug_name').val(myJson.result.slug_name);
               $('#seo_title').val(myJson.result.seo_title);
               $('#seo_keywords').val(myJson.result.seo_keywords);
               $('#seo_descriptions').val(myJson.result.seo_title);
               $('#social_title').val(myJson.result.social_title);
               $('#social_description').val(myJson.result.social_description);
               $('.social-img').attr('src', myJson.result.social_image);
               $("textarea#custom_head").val(myJson.result.custom_head);
               $("textarea#custom_body").val(myJson.result.custom_body);
            });
         });

         $(document).ready(function (){
            $('#save-builder').click(function (){
               let p_type = $('.page_block.active').find('#btn-main-page').length;
               let cd = $('input[name="code"]').val();

               $.get('{{ e(URL::to('landingpages/screenshot')) }}', {code:cd, p_type:p_type}, function (){

               });





            })
         })
      </script>
   </body>
</html>