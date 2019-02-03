// Logo
precision mediump float;
/////////////////////////////
//input
attribute vec3 vertPosition;
attribute vec2 vertTexCoord;
attribute vec3 vertNormal;
// attribute vec3 vertPosition2;
// attribute vec2 vertTexCoord2;
// Debug only
// attribute vec3 vertNormal2;


varying vec2 fragTexCoord;
varying vec3 fragNormal;
// varying vec2 fragTexCoord2;
// varying vec3 fragNormal2;
uniform mat4 mWorld;
uniform mat4 mView;
uniform mat4 mProj;

void main()
{
  fragTexCoord = vertTexCoord;
  fragNormal = (mWorld * vec4(vertNormal, 0.0)).xyz;

  gl_Position = mProj * mView * mWorld * vec4(vertPosition, 1.0);

}