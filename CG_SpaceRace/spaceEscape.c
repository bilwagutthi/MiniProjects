#include<GL/glut.h>
#include<stdio.h>
#include<stdlib.h>
#include<stdbool.h>
#include<string.h>
 
int i,q;
int score=0;
int screen=0;
bool collide=false;
char buffer[10];//change int to char
float sx=200,sy=70;//position of user spaceship
int osx[4],osy[4];//position of oponent spaceship
int divx=250,divy=4,movd;

void drawText(char ch[],int xpos, int ypos)
{
int numofchar=strlen(ch);
glLoadIdentity();
glRasterPos2f(xpos,ypos);
for(i=0;i<=numofchar-1;i++)
{
glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24,ch[i]);
}
}
 
void drawTextNum(char ch[],int numtext,int xpos, int ypos)//counting the score
{
int len;
int k;
k=0;
len=numtext-strlen(ch);
glLoadIdentity();
glRasterPos2f(xpos,ypos);
for(i=0;i<=numtext-1;i++){
if(i<len) glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24,'0');
else
{glutBitmapCharacter(GLUT_BITMAP_TIMES_ROMAN_24,ch[k]);k++;}
}
}
 
void ospos()
{
glClearColor(0.0,0.0,0.3,1.0);
for(i=0;i<4;i++){
if(rand()%2==0){osx[i]=200;}
else{osx[i]=300;}
osy[i]=1000-i*160;
}
}
void star(int x, int y)
{
glColor3f(0.9,1,0.0);
glBegin(GL_TRIANGLES);
glVertex2d(x-2,y);
glVertex2d(x+2,y);
glVertex2d(x,y+4);
glVertex2d(x-2,y);
glVertex2d(x+2,y);
glVertex2d(x,y-4);
glVertex2d(x,y-2);
glVertex2d(x,y+2);
glVertex2d(x-4,y);
glVertex2d(x,y-2);
glVertex2d(x,y+2);
glVertex2d(x+4,y);
glEnd();
}
void drawStar()
{int k;
glClearColor(0.0,0.0,0.3,1.0);
for (k=0;k<40;k++){
int x,y;
x=rand()%500;
y=rand()%500;
star(x,y);
}
}

void drawDivider()
{
glLoadIdentity();
glTranslatef(0, movd, 0);
for(i=1;i<=10;i++)
{
glClearColor(0.0,0.0,0.3,1.0);
glColor3f(0.9,0.8,0);
glBegin(GL_QUADS);
glVertex2f(divx-2,divy*15*i+18);
glVertex2f(divx-2,divy*15*i-18);
glVertex2f(divx+2,divy*15*i-18);
glVertex2f(divx+2,divy*15*i+18);
glEnd();
}
glLoadIdentity();
}

void drawSpaceship()//User Spaceship
{glColor3d(0.5,0.5,0.5);//side
glBegin(GL_QUADS);
glVertex2f(sx-25,sy-10);
glVertex2f(sx-10,sy-10);
glVertex2f(sx-10,sy+5);
glVertex2f(sx-22.5,sy+5);
glEnd();

glColor3d(0.5,0.5,0.5);
glBegin(GL_QUADS);
glVertex2f(sx+25,sy-10);
glVertex2f(sx+10,sy-10);
glVertex2f(sx+10,sy+5);
glVertex2f(sx+22.5,sy+5);
glEnd();

glColor3d(0.45,0.45,0.45);
glBegin(GL_QUADS);
glVertex2f(sx-5,sy+12);
glVertex2f(sx+5,sy+12);
glVertex2f(sx+5,sy+30);
glVertex2f(sx-5,sy+30);
glEnd();

glColor3d(0.5,0.5,0.5);//big tri
glBegin(GL_TRIANGLES);
glVertex2f(sx-25,sy-30);
glVertex2f(sx+25,sy-30);
glVertex2f(sx,sy+25);
glEnd();

glColor3d(0.425,0.425,0.425);//top tri
glBegin(GL_TRIANGLES);
glVertex2f(sx-5,sy+30);
glVertex2f(sx+5,sy+30);
glVertex2f(sx,sy+40);
glEnd();

glColor3d(0.44,0.444,0.444);//big tri shade
glBegin(GL_TRIANGLES);
glVertex2f(sx-17.5,sy-25);
glVertex2f(sx+17.5,sy-25);
glVertex2f(sx,sy+15);
glEnd();

glColor3d(0.42,0.42,0.42);//exhaust
glBegin(GL_QUADS);
glVertex2f(sx-20,sy-40);
glVertex2f(sx-5,sy-40);
glVertex2f(sx-7.5,sy-30);
glVertex2f(sx-17.5,sy-30);
glEnd();

glColor3d(0.42,0.42,0.42);
glBegin(GL_QUADS);
glVertex2f(sx+20,sy-40);
glVertex2f(sx+5,sy-40);
glVertex2f(sx+7.5,sy-30);
glVertex2f(sx+17.5,sy-30);
glEnd();

glColor3d(0.25,0.25,0.25);//big tri sides
glBegin(GL_TRIANGLES);
glVertex2f(sx-3.5,sy+5);
glVertex2f(sx-3.5,sy-22.5);
glVertex2f(sx-12.5,sy-22.5);
glEnd();

glColor3d(0.25,0.25,0.25);//big tri sides
glBegin(GL_TRIANGLES);
glVertex2f(sx+3.5,sy+5);
glVertex2f(sx+3.5,sy-22.5);
glVertex2f(sx+12.5,sy-22.5);
glEnd();
glColor3d(1,0.9,0.1);//fire yellow
glBegin(GL_TRIANGLES);
glVertex2f(sx-20,sy-40);
glVertex2f(sx-5,sy-40);
glVertex2f(sx-12.5,sy-60);
glEnd();
glColor3d(1,0.9,0.1);//fire
glBegin(GL_TRIANGLES);
glVertex2f(sx+20,sy-40);
glVertex2f(sx+5,sy-40);
glVertex2f(sx+12.5,sy-60);
glEnd();
glColor3d(1,0.5,0.1);//fire orange
glBegin(GL_TRIANGLES);
glVertex2f(sx-17.5,sy-40);
glVertex2f(sx-7.5,sy-40);
glVertex2f(sx-12.5,sy-50);
glEnd();
glColor3d(1,0.5,0.1);//fire
glBegin(GL_TRIANGLES);
glVertex2f(sx+17.5,sy-40);
glVertex2f(sx+7.5,sy-40);
glVertex2f(sx+12.5,sy-50);
glEnd();
} 
  
void drawOSS()//other spaceships
{
for(i= 0;i<4;i++)
{
glColor3d(0.45,0.45,0.45);//side
glBegin(GL_QUADS);
glVertex2f(osx[i]-15,osy[i]+30);
glVertex2f(osx[i]-10,osy[i]+30);
glVertex2f(osx[i]-10,osy[i]+15);
glVertex2f(osx[i]-15,osy[i]+15);
glEnd();

glColor3d(0.5,0.5,0.5);//side
glBegin(GL_QUADS);
glVertex2f(osx[i]+15,osy[i]+30);
glVertex2f(osx[i]+10,osy[i]+30);
glVertex2f(osx[i]+10,osy[i]+15);
glVertex2f(osx[i]+15,osy[i]+15);
glEnd();

glColor3d(0.5,0.5,0.5);//side
glBegin(GL_QUADS);
glVertex2f(osx[i]-25,osy[i]+30);
glVertex2f(osx[i],osy[i]+10);
glVertex2f(osx[i]+25,osy[i]+30);
glVertex2f(osx[i],osy[i]-35);
glEnd();

glColor3d(0.9,0.9,0.0);//light triangle
glBegin(GL_TRIANGLES);
glVertex2f(osx[i]-5,osy[i]-12.5);
glVertex2f(osx[i]+5,osy[i]-12.5);
glVertex2f(osx[i],osy[i]-27.5);
glEnd();

glColor3d(1,0.5,0.0);//fire
glBegin(GL_TRIANGLES);
glVertex2f(osx[i]-15,osy[i]+30);
glVertex2f(osx[i]-10,osy[i]+30);
glVertex2f(osx[i]-12.5,osy[i]+40);
glEnd();

glColor3d(1,0.5,0.0);//fire
glBegin(GL_TRIANGLES);
glVertex2f(osx[i]+15,osy[i]+30);
glVertex2f(osx[i]+10,osy[i]+30);
glVertex2f(osx[i]+12.5,osy[i]+40);
glEnd();
osy[i]=osy[i]-8;
if(osy[i]>sy-25-25&&osy[i]<sy+25+25&&osx[i]==sx)
{
collide=true;
}
if(osy[i]<-25)
{
if(rand()%2==0)
{
osx[i]=200;
}
else
{
osx[i]=300;
}
osy[i]=600; 
}
}
}

void Specialkey(int key, int x, int y)//allow to use navigation key for movement of
{
switch(key)
{
case GLUT_KEY_UP:for(i=0;i<4;i++)
		 {osy[i]=osy[i]-10;}
		 movd=movd-20;
		 break;	
case GLUT_KEY_DOWN:for(i=0;i<4;i++)
		   {osy[i]=osy[i]+10;}
		   movd=movd+20;
                   break;
case GLUT_KEY_LEFT:sx=200;
                  break;
case GLUT_KEY_RIGHT:sx=300;
                   break;
}
glutPostRedisplay();
}
 
void Normalkey(unsigned char key, int x, int y)
{
switch(key)
{
case '1':if(screen == 0)
             screen=1;
             break;
case '2':if(screen == 1)
             screen=2;
             break;
case 27:exit(0);
case 'w':for(i=0;i<4;i++)
		 {osy[i]=osy[i]-10;}
		 movd=movd-20;
		 break;	
case 's':for(i=0;i<4;i++)
		   {osy[i]=osy[i]+10;}
		   movd=movd+20;
                   break;
case 'd':sx=200;
	break;
case 'a':sx=300;
	break;
case 'x':exit(0);
break;
}
} 

void init()
{
glMatrixMode(GL_PROJECTION);
glLoadIdentity();
gluOrtho2D(0, 500, 0, 500);
glMatrixMode(GL_MODELVIEW);
}
 
void display()
{
int i,x[20],y[20];
if(screen == 0)
{
glClear(GL_COLOR_BUFFER_BIT);
glColor3f(1,1,1);
drawText("GOPALAN COLLEGE OF ENGINEERING", 75, 480);
drawText("AND MANAGEMENT",150 , 450);
drawText("Department of Computer Science and Engineering", 60, 410);
drawText("	A Mini Project on:", 50, 360);
drawText("	''SPACE ESCAPE'' ", 80, 340);
drawText("Made by:", 50, 300);
drawText("BILWA GUTTHI ", 100, 270);
drawText("DEEPIKA P", 100, 240);
drawText("(1GD16CS008)", 250, 270);
drawText("(1GD16CS011)", 250, 240);
drawText("Guided by:", 50, 200);
drawText("Mrs. Manju V N", 100, 170);
drawText("Press 1 to continue", 170, 100);
glutSwapBuffers();
}
else if(screen== 1)
{
glClear(GL_COLOR_BUFFER_BIT);
for(i=0;i<20;i++) x[i]=rand()%500 +5;
for(i=0;i<20;i++) y[i]=rand()%500 +5;
for(i=0;i<20;i++) star(x[i],y[i]);
glColor3f(0,0,0.1112);
glBegin(GL_POLYGON);
glVertex2f(10,490);
glVertex2f(490,490);
glVertex2f(490,400);
glVertex2f(10,400);
glEnd();
glColor3f(0.9,1,0.0);
glBegin(GL_LINE_LOOP);
glVertex2f(5,5);
glVertex2f(495,5);
glVertex2f(495,495);
glVertex2f(5,495);
glEnd();
glColor3f(0,0,0);
drawText("SPACE ESCAPE !",183,438);
glColor3f(0.5,0.5,0.5);
drawText("SPACE ESCAPE !",182,439);
glColor3f(1,1,1);
drawText("SPACE ESCAPE !",180,440);
glEnd();
drawText("INSTRUCTIONS",130,300);
drawText("The aim is to avoid colliding",130,270);
drawText("with the upcoming objects",130,240);
drawText("Use w or up arrow key to to accelerate", 130, 210);
drawText("Use a or left arrow key to move left", 130, 180);
drawText("Use d or right arrow key to move right", 130, 150);
drawText("Press 2 to Start!", 130, 120);
glutSwapBuffers();
}
else if(screen==4){
glClear(GL_COLOR_BUFFER_BIT);
for(i=0;i<20;i++) x[i]=rand()%500 +5;
for(i=0;i<20;i++) y[i]=rand()%500 +5;
for(i=0;i<20;i++) star(x[i],y[i]);
glColor3f(0,0,0.1112);
glBegin(GL_POLYGON);
glVertex2f(10,490);
glVertex2f(490,490);
glVertex2f(490,400);
glVertex2f(10,400);
glEnd();
glColor3f(0.9,1,0.0);
glBegin(GL_LINE_LOOP);
glVertex2f(5,5);
glVertex2f(495,5);
glVertex2f(495,495);
glVertex2f(5,495);
glEnd();
glColor3f(0,0,0);
drawText("SPACE ESCAPE !",183,438);
glColor3f(0.5,0.5,0.5);
drawText("SPACE ESCAPE !",182,439);
glColor3f(1,1,1);
drawText("SPACE ESCAPE !",180,440);
glEnd();
drawText("Press x to quit",200,150);
drawText("Game Over", 200,250);
drawText("Final Score :", 200,200);
drawTextNum(buffer, 6, 300,200);
glutSwapBuffers();

}
else
{
glClear(GL_COLOR_BUFFER_BIT);
drawStar(); 
drawDivider();
drawSpaceship();
drawOSS();
movd=movd-16;
if(movd<-60)
{
movd=0;
}
score=score+1;
glColor3f(1,1,1);
drawText("Score:", 360,455);
sprintf(buffer,"%d",score);
drawTextNum(buffer, 6, 420,455);
glutSwapBuffers(); 
for(q=0;q<=17000000;q++){;}
if(collide==true)
{
screen=4;
}}
}

int main(int argc, char **argv)
{
glutInit(&argc,argv);
glutInitDisplayMode(GLUT_RGB|GLUT_DOUBLE);
glutInitWindowPosition(200,10);
glutInitWindowSize(650,650);
glutCreateWindow("Space Escape Game");
ospos();
init();
glutDisplayFunc(display);
glutSpecialFunc(Specialkey);
glutKeyboardFunc(Normalkey);
glutIdleFunc(display);
glutMainLoop();
return 0;
}
