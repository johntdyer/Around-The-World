/* <![CDATA[ */
		var ge;
		google.load("earth", "1");

		function init() {
		google.earth.createInstance('map3d', initCB, failureCB);
		}

		function initCB(instance) {
		ge = instance;
		ge.getWindow().setVisibility(true);

		// add a navigation control
		ge.getNavigationControl().setVisibility(ge.VISIBILITY_AUTO);

		// add some layers
		ge.getLayerRoot().enableLayerById(ge.LAYER_BORDERS, true);
		ge.getLayerRoot().enableLayerById(ge.LAYER_ROADS, true);

		// fly to Hard Rock
		var la = ge.createLookAt('');
		la.set(28.476299, -81.464867,
			10, // altitude
			ge.ALTITUDE_RELATIVE_TO_GROUND,
			0, // heading
			10, // straight-down tilt
			120 // range (inverse of zoom)
			);
		ge.getView().setAbstractView(la);


		document.getElementById('installed-plugin-version').innerHTML =
			ge.getPluginVersion().toString();
		}

		function failureCB(errorCode) {
		}

		var currentKmlObject = null;

		function fetchKmlFromInput() {
		// remove the old KML object if it exists
		if (currentKmlObject) {
			ge.getFeatures().removeChild(currentKmlObject);
			currentKmlObject = null;
		}

		var kmlUrlBox = document.getElementById('kml-url');
		var kmlUrl = kmlUrlBox.value;

		google.earth.fetchKml(ge, URL, finishFetchKml);
		}

		function finishFetchKml(kmlObject) {
		// check if the KML was fetched properly
		if (kmlObject) {
			// add the fetched KML to Earth
			currentKmlObject = kmlObject;
			ge.getFeatures().appendChild(currentKmlObject);
		} else {
			// wrap alerts in API callbacks and event handlers
			// in a setTimeout to prevent deadlock in some browsers
			setTimeout(function() {
				alert('Bad or null KML.');
			}, 0);
		}
		}

		function buttonClick() {
		fetchKmlFromInput();
		}

		/* ]]> */