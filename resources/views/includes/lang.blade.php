<div class="card-body">
    <div class="language-selector-wrapper">
        <h6>{{ GoogleTranslate::trans('Select Language', app()->getLocale()) }}</h6>
        <select class="form-select changeLang language-selector" id="language-select">
            <option value="nl" {{ app()->getLocale() == 'nl' ? 'selected' : '' }}>Nederlands</option>
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>François</option>
            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
        </select>
    </div>
</div>

<script>
   document.getElementById('language-select').addEventListener('change', function() {
    var selectedLang = this.value;
    var currentUrl = window.location.href;
    var url = new URL(currentUrl);
    var params = url.searchParams;

    // Check if lang parameter exists
    if (params.has('lang')) {
        // Replace existing lang parameter with the new one
        params.set('lang', selectedLang);
    } else {
        // Add lang parameter to the URL
        params.append('lang', selectedLang);
    }

    // Construct the new URL with updated parameters
    var newUrl = url.origin + url.pathname + '?' + params.toString() + url.hash;
    
    // Redirect to the new URL
    window.location.href = newUrl;
   });
</script>