<div x-data="animateRating()" x-init="animate({{ $gameRating }})"
    class="w-12 h-12 {{ $gameRating > 60 && $gameRating < 80 ? 'to-yellow' : '' }} {{ $gameRating > 80 ? 'to-green' : '' }} bg-gray-700 border-4 border-red-600 rounded-full shadow">
    <div class="font-semibold text-sm flex justify-center items-center h-full text-gray-300" x-text="rating">
    </div>
</div>


<script>
    window.animateRating = function(){
        return {
            rating: 0,
            animate(finalRating) {
                let counter = setInterval( () => {
                    this.rating++
                    if(this.rating === finalRating){
                        clearInterval(counter);
                    }
                }, 20 );
            }
        }
    }
</script>
