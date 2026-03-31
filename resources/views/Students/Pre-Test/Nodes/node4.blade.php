<!DOCTYPE html>
<html lang="fil">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Node 4 - Government Response</title>

<link rel="stylesheet" href="{{ asset('css/home.css') }}">
<script src="https://cdn.tailwindcss.com"></script>

<style>
.modal-backdrop {
    transition: opacity 0.3s ease;
}
.modal-content {
    transition: transform 0.3s ease, opacity 0.2s ease;
}
</style>
</head>

<body>

<!-- 🌿 DECOR -->
<span class="deco deco-1">🌿</span>
<span class="deco deco-2">🦋</span>
<span class="deco deco-3">🌸</span>
<span class="deco deco-4">🗺️</span>

<!-- 🎯 HEADER (NOW ABOVE CARDS) -->
<section class="text-center py-16 px-6">

    <h1 class="text-4xl font-extrabold text-green-800 mb-4">
        🏛️ Tugon ng Pamahalaan
    </h1>

    <p class="text-gray-700 max-w-xl mx-auto">
        Paano nakatutulong ang mga batas at programa sa paghahanda sa sakuna?
        I-click ang bawat card upang matuto.
    </p>

</section>

<!-- 🎮 CARDS -->
<div class="max-w-4xl mx-auto grid grid-cols-2 md:grid-cols-3 gap-6 px-6 pb-20">

    <button onclick="openCard(0)" 
    class="bg-gradient-to-br from-blue-500 to-blue-700 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">🛡️</div>
        <div class="font-bold">RA 10121</div>
        <div class="text-xs opacity-80">Disaster Law</div>
    </button>

    <button onclick="openCard(1)" 
    class="bg-gradient-to-br from-green-400 to-green-600 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">📢</div>
        <div class="font-bold">Early Warning</div>
        <div class="text-xs opacity-80">Alert System</div>
    </button>

    <button onclick="openCard(2)" 
    class="bg-gradient-to-br from-red-400 to-red-600 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">🚨</div>
        <div class="font-bold">Evacuation</div>
        <div class="text-xs opacity-80">Safe Movement</div>
    </button>

    <button onclick="openCard(3)" 
    class="bg-gradient-to-br from-teal-400 to-teal-600 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">🌍</div>
        <div class="font-bold">RA 9729</div>
        <div class="text-xs opacity-80">Climate Act</div>
    </button>

    <button onclick="openCard(4)" 
    class="bg-gradient-to-br from-orange-400 to-orange-600 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">🗑️</div>
        <div class="font-bold">RA 9003</div>
        <div class="text-xs opacity-80">Waste Law</div>
    </button>

    <button onclick="openCard(5)" 
    class="bg-gradient-to-br from-gray-500 to-gray-700 text-white p-6 rounded-2xl shadow-xl hover:scale-105 hover:-translate-y-1 transition text-center">
        <div class="text-3xl mb-1">🚑</div>
        <div class="font-bold">APSEMO</div>
        <div class="text-xs opacity-80">Emergency Team</div>
    </button>

</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black/70 opacity-0 invisible transition modal-backdrop p-4">

    <div class="bg-white rounded-2xl w-full max-w-xl modal-content scale-95 opacity-0 overflow-hidden">

        <div id="modalContent" class="max-h-[80vh] overflow-y-auto p-6"></div>

        <div class="p-4 border-t bg-gray-50">
            <button onclick="closeModal()" 
                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-lg font-semibold transition">
                Tapos
            </button>
        </div>

    </div>
</div>

<script>
const data = [

{
title:"Republic Act 10121",
img:"{{ asset('pictures/Node4/ra10121.png') }}",
content:`
<p class="font-semibold mb-2">
➡ Disaster Risk Reduction and Management Act of 2010
</p>

<p class="font-bold mt-2">📌 Layunin:</p>
<ul class="list-disc ml-5 mb-2">
    <li>Paghahanda bago, habang, at pagkatapos ng sakuna</li>
</ul>

<p class="font-bold mt-2">📍 Halimbawa sa Albay:</p>
<ul class="list-disc ml-5 mb-2">
    <li>Disaster drills</li>
    <li>Rescue operations</li>
</ul>

<p class="font-bold mt-2">💡 Tandaan:</p>
<ul class="list-disc ml-5 mb-2">
    <li>Ito ang pangunahing batas sa disaster management</li>
</ul>

<p class="text-xs text-gray-500 mt-3">
Source: 
<a href="https://lawphil.net/statutes/repacts/ra2010/ra_10121_2010.html" target="_blank" class="underline">
lawphil.net
</a>
</p>
`
},

{
title:"Early Warning System",
img:"{{ asset('pictures/Node4/ews.png') }}",
content:"Nagbibigay ng maagang babala tulad ng text alerts, sirena, at anunsyo upang maiwasan ang pinsala."
},

{
title:"Evacuation Program",
img:"{{ asset('pictures/Node4/evacuation.png') }}",
content:"Paglikas ng mga mamamayan sa ligtas na lugar bago dumating ang sakuna."
},

{
title:"RA 9729",
img:"{{ asset('pictures/Node4/ra9729.png') }}",
content:"Climate Change Act na naglalayong protektahan ang kalikasan laban sa epekto ng climate change."
},

{
title:"RA 9003",
img:"{{ asset('pictures/Node4/ra9003.png') }}",
content:"Ecological Solid Waste Management Act na nagtataguyod ng tamang pamamahala ng basura."
},

{
title:"APSEMO",
img:"{{ asset('pictures/Node4/apsemo.png') }}",
content:"Albay Public Safety and Emergency Management Office na nangunguna sa disaster response sa Albay."
}

];

function openCard(i){
    const modal = document.getElementById('modal');
    const box = modal.querySelector('.modal-content');

    document.getElementById('modalContent').innerHTML = `
        <div class="bg-gray-50 p-4 rounded-xl border space-y-3">

            <h2 class="text-xl font-extrabold text-green-800 text-center">
                ${data[i].title}
            </h2>

            <div class="grid md:grid-cols-2 gap-4 items-start">

                <div>
                    <img src="${data[i].img}" class="w-full rounded-xl shadow">
                </div>

                <div class="text-gray-700 leading-relaxed">
                    ${data[i].content}
                </div>

            </div>

        </div>
    `;

    modal.classList.remove('invisible','opacity-0');
    modal.classList.add('opacity-100');

    box.classList.remove('scale-95','opacity-0');
    box.classList.add('scale-100','opacity-100');
}

function closeModal(){
    const modal = document.getElementById('modal');
    const box = modal.querySelector('.modal-content');

    modal.classList.add('invisible','opacity-0');
    box.classList.add('scale-95','opacity-0');
}
</script>

</body>
</html>