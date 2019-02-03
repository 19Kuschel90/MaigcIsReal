///////////////////////////////////////////////////////////////
// Start webgl and get resources (Vertex Shader, Fragment Shader, 3D Model, Texture)
export class CLogo {

    constructor(vs, fs, model3D, textue, _canvas) {

        this.InitWebGL(vs, fs, model3D, textue, _canvas);
    }

    InitWebGL(vs, fs, model3D, textue, _canvas) {
        try {
            var othis = this;
            // 1. get Vertex Shader
            othis.loadTextResource(vs, function(vsErr, vsText) {
                if (vsErr) {
                    throw new error("Vertex Shader not found");

                } else {
                    // 2. get Fragment Shader
                    othis.loadTextResource(fs, function(fsErr, fsText) {
                        if (fsErr) {
                            throw new error("Fragment Shader not found");

                        } else {
                            // 3. get 3D Model
                            othis.loadJSONResource(model3D, function(modelErr, modelObj) {
                                if (modelErr) {
                                    throw new error("Texture not found");

                                } else {
                                    //4. get Texture
                                    othis.loadImage(textue, function(imgErr, img) {
                                        if (imgErr) {
                                            throw new error("Texture not found");
                                        } else {
                                            // 5. Start webgl
                                            othis.RunWebGL(vsText, fsText, img, modelObj, _canvas);
                                        }
                                    });
                                }
                            });
                        }
                    });
                }
            });

        } catch (e) {
            console.error('Logo Webgl', e);
        }
    }

    loadTextResource(url, callback) {

        var request = new XMLHttpRequest();

        request.open('GET', url + '?please-dont-cache=' + Math.random(), true);
        request.onload = function() {
            if (request.status < 200 || request.status > 299) {
                callback('Error: HTTP Status ' + request.status + ' on resource ' + url);
            } else {
                callback(null, request.responseText);
            }
        };
        try {
            request.send(); // No Server Error
        } catch (e) {}

    };

    // Load Image
    loadImage(url, callback) {
        var image = new Image();
        image.onload = function() {
            callback(null, image);
        };
        image.src = url;
    };

    // load josn
    loadJSONResource(url, callback) {
        this.loadTextResource(url, function(err, result) {
            if (err) {
                callback(err);
            } else {
                try {
                    callback(null, JSON.parse(result));
                } catch (e) {
                    callback(e);
                }
            }
        });
    };

    ///////////////////////////////////////////////////////
    // LOGO
    /////////////////
    // Need:
    /////////////////////////////////
    // id: logo-surface,
    // class:
    RunWebGL(vertexShaderText, fragmentShaderText, texture, Model3D, _canvas) {

        var canvas = document.getElementById(_canvas);
        var gl = canvas.getContext('webgl');

        if (!gl) {
            console.log('WebGL not supported, falling back on experimental-webgl');
            gl = canvas.getContext('experimental-webgl');
            runFail();
        }

        if (!gl) {
            alert('Your browser does not support WebGL');
            runFail();
        }
        ///////////////////////////////////////
        gl.enable(gl.DEPTH_TEST); // Enable depth testing
        gl.enable(gl.CULL_FACE);
        gl.frontFace(gl.CCW);
        gl.cullFace(gl.BACK);
        ////////////////////////////////////////////
        // Create shaders
        var vertexShader = gl.createShader(gl.VERTEX_SHADER);
        var fragmentShader = gl.createShader(gl.FRAGMENT_SHADER);
        ////////////////////////////////////////////////////
        // Returns the source code to the shader
        // Syntax: void gl.shaderSource(shader, source);
        gl.shaderSource(vertexShader, vertexShaderText);
        gl.shaderSource(fragmentShader, fragmentShaderText);
        ////////////////////////////////////////////////////////////////
        // CompileShader Vertex Shader
        gl.compileShader(vertexShader);
        if (!gl.getShaderParameter(vertexShader, gl.COMPILE_STATUS)) {
            console.error('ERROR compiling vertex shader!', gl.getShaderInfoLog(vertexShader));
            return;
        }
        ////////////////////////////////////////////////////////////////
        // CompileShader Fragment Shader
        gl.compileShader(fragmentShader);
        if (!gl.getShaderParameter(fragmentShader, gl.COMPILE_STATUS)) {
            console.error('ERROR compiling fragment shader!', gl.getShaderInfoLog(fragmentShader));
            return;
        }
        /////////////////////////////////////////////////////////////////////////
        // initializes a WebGLProgram object.
        var program = gl.createProgram();
        /////////////////////////////////////////////
        // assign the vertex shader  to the web program
        gl.attachShader(program, vertexShader);
        ////////////////////////////////////////////////
        // assign the fragment shader  to the web program
        gl.attachShader(program, fragmentShader);
        ////////////////////////////////////////////////////////
        // The WebGLRenderingContext.linkProgram() method of the WebGL API links a given WebGLProgram
        // to the attached vertex and fragment shaders.
        // Syntax: void gl.linkProgram(program);
        gl.linkProgram(program);
        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            console.error('ERROR linking program!', gl.getProgramInfoLog(program));
            return;
        }
        ////////////////////////////////////////////////////////////
        // Checks if the program can be used
        gl.validateProgram(program);
        if (!gl.getProgramParameter(program, gl.VALIDATE_STATUS)) {
            console.error('ERROR validating program!', gl.getProgramInfoLog(program));
            return;
        }
        ////////////////////////////////////////////////////////////////////////
        // Create Buffer / Array
        var vertices3DModelArray = Model3D.meshes[0].vertices;
        var indices3DModelArray = [].concat.apply([], Model3D.meshes[0].faces);
        var texCoords3DModelArray = Model3D.meshes[0].texturecoords[0];
        var normals3DModelArray = Model3D.meshes[0].normals;
        ///////////////////////////////////////////////////////////////////////////////
        // The WebGLRenderingContext.createBuffer () method of the WebGL API creates and
        // initializes a WebGLBuffer storing data such as vertices or colors.
        // Syntax: WebGLBuffer gl.createBuffer();
        var posVertexBufferObject = gl.createBuffer();
        var texCoordVertexBufferObject = gl.createBuffer();
        var indexBufferObject = gl.createBuffer();
        var normalBufferObject = gl.createBuffer();
        //////////////////////////////////////////////////////////////
        //  Bind buffer
        // Syntax: void gl.bindBuffer(target, buffer);
        // target =  gl.ARRAY_BUFFER
        // buffer = posVertexBufferObject
        // Vertex Buffer Object to Canvas().Context = (gl.ARRAY_BUFFER)
        //
        // gl.ARRAY_BUFFER: Buffer containing vertex attributes, such as vertex coordinates,
        // texture coordinate data, or vertex color data.
        //
        // gl.ELEMENT_ARRAY_BUFFER: Buffer used for element indices.
        // The WebGLRenderingContext.bufferData() method of the WebGL API initializes and
        // creates the buffer object's data store.
        gl.bindBuffer(gl.ARRAY_BUFFER, posVertexBufferObject);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices3DModelArray), gl.STATIC_DRAW);
        gl.bindBuffer(gl.ARRAY_BUFFER, texCoordVertexBufferObject);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(texCoords3DModelArray), gl.STATIC_DRAW);
        gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, indexBufferObject);
        gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, new Uint16Array(indices3DModelArray), gl.STATIC_DRAW);
        gl.bindBuffer(gl.ARRAY_BUFFER, normalBufferObject);
        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(normals3DModelArray), gl.STATIC_DRAW);
        gl.bindBuffer(gl.ARRAY_BUFFER, posVertexBufferObject); // fix
        ///////////////////////////////////////////////////////////////////////////

        var positionAttribLocation = gl.getAttribLocation(program, 'vertPosition');
        gl.vertexAttribPointer(
            positionAttribLocation, // Attribute location
            3, // Number of elements per attribute
            gl.FLOAT, // Type of elements
            gl.FALSE,
            3 * Float32Array.BYTES_PER_ELEMENT, // Size of an individual vertex
            0 // Offset from the beginning of a single vertex to this attribute
        );
        gl.enableVertexAttribArray(positionAttribLocation);

        gl.bindBuffer(gl.ARRAY_BUFFER, texCoordVertexBufferObject);
        var texCoordAttribLocation = gl.getAttribLocation(program, 'vertTexCoord');
        gl.vertexAttribPointer(
            texCoordAttribLocation, // Attribute location
            2, // Number of elements per attribute
            gl.FLOAT, // Type of elements
            gl.FALSE,
            2 * Float32Array.BYTES_PER_ELEMENT, // Size of an individual vertex
            0
        );
        gl.enableVertexAttribArray(texCoordAttribLocation);

        gl.bindBuffer(gl.ARRAY_BUFFER, normalBufferObject);
        var normalAttribLocation = gl.getAttribLocation(program, 'vertNormal');
        gl.vertexAttribPointer(
            normalAttribLocation,
            3, gl.FLOAT,
            gl.TRUE,
            3 * Float32Array.BYTES_PER_ELEMENT,
            0
        );
        gl.enableVertexAttribArray(normalAttribLocation);

        //
        // Create texture
        //
        var susanTexture = gl.createTexture();
        gl.bindTexture(gl.TEXTURE_2D, susanTexture);
        gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
        gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
        gl.texImage2D(
            gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA,
            gl.UNSIGNED_BYTE,
            texture
        );
        gl.bindTexture(gl.TEXTURE_2D, null);

        // Tell OpenGL state machine which program should be active.
        gl.useProgram(program);

        var matWorldUniformLocation = gl.getUniformLocation(program, 'mWorld');
        var matViewUniformLocation = gl.getUniformLocation(program, 'mView');
        var matProjUniformLocation = gl.getUniformLocation(program, 'mProj');

        var worldMatrix = new Float32Array(16);
        var viewMatrix = new Float32Array(16);
        var projMatrix = new Float32Array(16);
        mat4.identity(worldMatrix);
        mat4.lookAt(viewMatrix, [0, 0, -20], [0, 0, 0], [0, 1, 0]);
        mat4.perspective(projMatrix, glMatrix.toRadian(45), canvas.width / canvas.height, 0.1, 1000.0);

        gl.uniformMatrix4fv(matWorldUniformLocation, gl.FALSE, worldMatrix);
        gl.uniformMatrix4fv(matViewUniformLocation, gl.FALSE, viewMatrix);
        gl.uniformMatrix4fv(matProjUniformLocation, gl.FALSE, projMatrix);

        var xRotationMatrix = new Float32Array(16);
        var yRotationMatrix = new Float32Array(16);

        //
        // Lighting information
        //
        gl.useProgram(program);

        var ambientUniformLocation = gl.getUniformLocation(program, 'ambientLightIntensity');
        var sunlightDirUniformLocation = gl.getUniformLocation(program, 'sun.direction');
        var sunlightIntUniformLocation = gl.getUniformLocation(program, 'sun.color');

        gl.uniform3f(ambientUniformLocation, 0.2, 0.2, 0.2);
        gl.uniform3f(sunlightDirUniformLocation, 5.0, -5.0, -2.0);
        gl.uniform3f(sunlightIntUniformLocation, 0.9, 1.0, 1.0);

        //
        // Main render loop
        //
        var identityMatrix = new Float32Array(16);
        mat4.identity(identityMatrix);
        var angle = 0;

        var loop = function() {
            canvas.onmousemove = function(e) {

                x = e.offsetX || e.clientX - canvas.offsetLeft;
                y = e.offsetY || e.clientY - canvas.offsetTop;
                // Focus / Mittel Punkt
                x = x - 25;
                y = y - 25;


                gl.uniform3f(sunlightDirUniformLocation, -x, -y, 1.0);
            }
            angle = performance.now() / 1000 / 6 * 2 * Math.PI;
            mat4.rotate(yRotationMatrix, identityMatrix, angle, [0, 1, 0]);
            mat4.rotate(xRotationMatrix, identityMatrix, angle / 4, [1, 0, 0]);
            mat4.mul(worldMatrix, yRotationMatrix, xRotationMatrix);
            gl.uniformMatrix4fv(matWorldUniformLocation, gl.FALSE, worldMatrix);

            gl.clearColor(0.0, 0.0, 0.0, 0.0);
            gl.clear(gl.DEPTH_BUFFER_BIT | gl.COLOR_BUFFER_BIT);

            gl.bindTexture(gl.TEXTURE_2D, susanTexture);
            gl.activeTexture(gl.TEXTURE0);

            gl.drawElements(gl.TRIANGLES, indices3DModelArray.length, gl.UNSIGNED_SHORT, 0);

            requestAnimationFrame(loop);
        };
        requestAnimationFrame(loop);
    };

}