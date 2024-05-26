if ("geolocation" in navigator) {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            var routeName = "weather";
            var redirectUrl =
                routeName + "?lat=" + latitude + "&lon=" + longitude;
            window.location.href = redirectUrl;
        },
        function (error) {
            console.error("位置情報の取得に失敗しました:", error.message);
            alert("位置情報の取得に失敗しました。");
        }
    );
} else {
    console.error("このブラウザは位置情報の取得に対応していません。");
    alert("このブラウザは位置情報の取得に対応していません。");
}
