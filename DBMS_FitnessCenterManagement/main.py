from tkinter import *
import mysql.connector
from tkinter import messagebox
from datetime import *
from tkinter import ttk

bgb='#242422'
fgg='#8FAE11'
fon='arial 13 bold'
##command set up##
##member commands
def madd():
    mid=IntVar()
    mnam=StringVar()
    mnum=StringVar()
    mgen=StringVar()
    mdob=IntVar()
    sub=StringVar()
    fmadd=Frame(root,height=350,width=500,relief=SUNKEN,borderwidth=3,bg=bgb)
    lab=Label(fmadd,text='ADD NEW MEMBER',fg=fgg,bg=bgb,font='arial 15 bold').pack(side=TOP)
    lmid=Label(fmadd,text='ID',fg=fgg,bg=bgb,font=fon)
    lmnam=Label(fmadd,text='Name',fg=fgg,bg=bgb,font=fon)
    lmnum=Label(fmadd,text='Number',fg=fgg,bg=bgb,font=fon)
    lmgen=Label(fmadd,text='Gender',fg=fgg,bg=bgb,font=fon)
    lmdob=Label(fmadd,text='Date of birth(yyyymmdd)',fg=fgg,bg=bgb,font=fon)
    lsub=Label(fmadd,text='Subscription type',fg=fgg,bg=bgb,font=fon)
    emid=Entry(fmadd,textvariable=mid)
    emnam=Entry(fmadd,textvariable=mnam)
    emnum=Entry(fmadd,textvariable=mnum)
    emgen=OptionMenu(fmadd,mgen,'Female','Male','Other')
    emdob=Entry(fmadd,textvariable=mdob)
    esub=Entry(fmadd,textvariable=sub)
    def mreset():
        emid.delete(0,END)
        emnam.delete(0,END)
        emnum.delete(0,END)
        emdob.delete(0,END)
        esub.delete(0,END)
    mreset()
    def msubmit():
        mmid=mid.get()
        mmnam=mnam.get()
        mmnum=mnum.get()
        mmgen=mgen.get()
        mmdob=mdob.get()
        msub=sub.get()
        try:
            inmem="Insert into member(mid,mname,mnum,mgen,mdob,sub) values(%s,%s,%s,%s,%s,%s)"
            valmem=(mmid,mmnam,mmnum,mmgen,mmdob,msub)
            c.execute(inmem,valmem)
            mydb.commit()
            messagebox.showinfo('Member added','Member successfully added')
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
        c.execute("SELECT * FROM member")
        mydb.commit()
        mreset()
    def quitmem():
        fmadd.destroy()
    
    submit=Button(fmadd,text='SUBMIT',width=7,command=msubmit,fg=fgg,bg=bgb,font=fon)
    reset=Button(fmadd,text='RESET',width=7,command=mreset,fg=fgg,bg=bgb,font=fon)
    butquit=Button(fmadd,text='QUIT',width=7,command=quitmem,fg=fgg,bg=bgb,font=fon)
    
    fmadd.pack(side=BOTTOM)
    fmadd.pack_propagate(0)
    lmid.place(x=10,y=40)
    lmnam.place(x=10,y=80)
    lmnum.place(x=10,y=120)
    lmgen.place(x=10,y=160)
    lmdob.place(x=10,y=200)
    lsub.place(x=10,y=240)
    emid.place(x=250,y=40)
    emnam.place(x=250,y=80)
    emnum.place(x=250,y=120)
    emgen.place(x=250,y=160)
    emdob.place(x=250,y=200)
    esub.place(x=250,y=240)
    submit.place(x=25,y=300)
    reset.place(x=125,y=300)
    butquit.place(x=225,y=300)
def memdelete():
    mid=IntVar()
    fmdel=Frame(root,height=300,width=300,bg=bgb,relief=SUNKEN,borderwidth=3)
    lab=Label(fmdel,text="Delete Member",fg=fgg,bg=bgb,font='arial 15 bold').pack(side=TOP)
    lmdel=Label(fmdel,text="Enter id to delete",fg=fgg,bg=bgb,font=fon)
    emdel=Entry(fmdel,textvariable=mid,width=7)
    def mreset():
        emdel.delete(0,END)
    def msubmit():
        mdelid=mid.get()
        try:
            sql="Delete from member where mid = %s"
            c.execute("Delete from member where mid = %s"%(mdelid,))
            mydb.commit()
            mreset
            messagebox.showinfo('Deleted',"Member succuessfully deleted")
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
    submit=Button(fmdel,text='SUBMIT',command=msubmit,fg=fgg,bg=bgb,font=fon,width=7)
    reset=Button(fmdel,text='RESET',command=mreset,fg=fgg,bg=bgb,font=fon,width=7)
    def quitmem():
        fmdel.destroy()
    butquit=Button(fmdel,text='QUIT',command=quitmem,fg=fgg,bg=bgb,font=fon,width=7)
    
    fmdel.pack(side=BOTTOM)
    fmdel.pack_propagate(0)
    lmdel.place(x=10,y=100)
    emdel.place(x=160,y=100)
    submit.place(x=10,y=250)
    reset.place(x=110,y=250)
    butquit.place(x=210,y=250)
def mupdate():
    mid=IntVar()
    new=StringVar()
    fmupdate=Frame(root,height=300,width=450,relief=SUNKEN,borderwidth=3,bg=bgb)
    fmupdate.pack(side=BOTTOM)
    fmupdate.pack_propagate(0)
    lab1=Label(fmupdate,text='MEMBER UPDATE',font='arial 16 bold',fg=fgg,bg=bgb).pack(side=TOP)
    lab2=Label(fmupdate,text='Enter ID',fg=fgg,bg=bgb,font=fon).place(x=20,y=60)
    leb3=Label(fmupdate,text='Select value to be changed',fg=fgg,bg=bgb,font=fon).place(x=20,y=120)
    lab4=Label(fmupdate,text='Enter new value',fg=fgg,bg=bgb,font=fon).place(x=20,y=180)
    var=StringVar()
    opt=OptionMenu(fmupdate,var,'Number','Type').place(x=250,y=120)
    en1=Entry(fmupdate,textvariable=mid).place(x=250,y=60)
    en2=Entry(fmupdate,textvariable=new).place(x=250,y=180)
    def submit():
        sub=var.get()
        gmid=mid.get()
        gnew=new.get()
        try:
            if(sub=='Number'):
                c.execute('update member set mnum=%s where mid=%s',(gnew,gmid))
                mydb.commit()
            else:
                c.execute('update member set sub=%s where mid=%s',(gnew,gmid))
                mydb.commit()
            messagebox.showinfo('Updated',"Member succuessfully Updated")
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
    def mquit():
        fmupdate.destroy()
    sumbit=Button(fmupdate,text="Submit",command=submit,fg=fgg,bg=bgb,font=fon,width=7).place(x=90,y=240)
    mquit=Button(fmupdate,text="Quit",command=mquit,fg=fgg,bg=bgb,font=fon,width=7).place(x=280,y=240)
def mview():
    fmview=Frame(root,height=300,width=300,relief=SUNKEN,borderwidth=3,bg=bgb)
    fmview.pack(side=BOTTOM,fill=BOTH)
    fmview.pack_propagate(0)
    c.execute("SELECT * FROM member")
    mviewlist=c.fetchall()
    mydb.commit()
    lab1=Label(fmview,text='Memeber Information',font='Ariel 15 bold',fg=fgg,bg=bgb).pack(side=TOP)
    treeview = ttk.Treeview(fmview)
    style=ttk.Style()
    style.configure("Treeview.Heading",font='Ariel 12 bold',bg='green')
    treeview.pack(side=TOP)
    #scrollbar=ttk.Scrollbar(fmview,orient='vertical',command=treeview.yview)
    #scrollbar.pack(side=RIGHT,fill=Y)
    #treeview.configure(yscrollcommand=scrollbar.set)
    treeview["columns"] = ["mid", "mname",'mnum','mgen','mdob','sub']
    treeview["show"] = "headings"
    treeview.heading("mid", text="Member ID")
    treeview.column("mid",minwidth=100,width=100,stretch=NO)
    treeview.heading("mname", text="Name")
    treeview.column("mname",minwidth=100,width=100,stretch=NO)
    treeview.heading("mnum", text="Number")
    treeview.column("mnum",minwidth=100,width=100,stretch=NO)
    treeview.heading("mgen", text="Gender")
    treeview.column("mgen",minwidth=100,width=100,stretch=NO)
    treeview.heading("mdob", text="D.O.B")
    treeview.column("mdob",minwidth=100,width=100,stretch=NO)
    treeview.heading("sub", text="Subscription")
    treeview.column("sub",minwidth=100,width=150,stretch=NO)
    index = iid = 0
    for row in mviewlist:
        treeview.insert("", index, iid, values=row)
        index = iid = index + 1
    def mvquit():
        fmview.destroy()
    but=Button(fmview,text='Quit',command=mvquit,fg=fgg,bg=bgb,font=fon).pack(side=BOTTOM)
#####TRAINER COMMANDS######
def tadd():
    tid=IntVar()
    tnam=StringVar()
    tnum=IntVar()
    ftadd=Frame(root,height=300,width=300,bg=bgb,relief=SUNKEN,borderwidth=3)
    ftadd.pack(side=BOTTOM)
    ftadd.pack_propagate(0)
    lab=Label(ftadd,text='ADD NEW TRAINER',fg=fgg,bg=bgb,font='arial 15 bold').pack(side=TOP)
    ltid=Label(ftadd,text='ID',fg=fgg,bg=bgb,font=fon).place(x=20,y=60)
    ltnam=Label(ftadd,text='Name',fg=fgg,bg=bgb,font=fon).place(x=20,y=120)
    ltnum=Label(ftadd,text='Number',fg=fgg,bg=bgb,font=fon).place(x=20,y=180)
    etid=Entry(ftadd,textvariable=tid)
    etid.place(x=150,y=60)
    etnam=Entry(ftadd,textvariable=tnam)
    etnam.place(x=150,y=120)
    etnum=Entry(ftadd,textvariable=tnum)
    etnum.place(x=150,y=180)
    def submit():
        gtid=tid.get()
        gtnam=tnam.get()
        gtnum=tnum.get()
        try:
            inequ="Insert into trainer(tid,tname,tnum) values(%s,%s,%s)"
            valequ=(gtid,gtnam,gtnum)
            c.execute(inequ,valequ)
            mydb.commit()
            reset
            messagebox.showinfo('Trainer added','Trainer successfully added')
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
    def reset():
        etid.delete(0,END)
        etnam.delete(0,END)
        etnum.delete(0,END)
    def tquit():
        ftadd.destroy()
    submit=Button(ftadd,text="Submit",command=submit,fg=fgg,bg=bgb,font=fon,width=7).place(x=30,y=240)
    reset=Button(ftadd,text="Reset",command=reset,fg=fgg,bg=bgb,font=fon,width=7).place(x=115,y=240)
    tquit=Button(ftadd,text="Quit",command=tquit,fg=fgg,bg=bgb,font=fon,width=7).place(x=200,y=240)
def tview():
    ftview=Frame(root,height=300,width=500,bg=bgb,relief=SUNKEN,borderwidth=3)
    ftview.pack(side=BOTTOM)
    c.execute("SELECT * FROM trainer")
    tviewlist=c.fetchall()
    mydb.commit()
    lab=Label(ftview,text='TRAINER INFOMATION',fg=fgg,bg=bgb,font='arial 15 bold').pack(side=TOP)
    treeview = ttk.Treeview(ftview)
    style=ttk.Style()
    style.configure("Treeview.Heading",font='Ariel 12 bold',bg='green')
    #scrollbar=ttk.Scrollbar(ftview,orient='vertical',command=treeview.yview)
    treeview.pack(side=TOP)
    #scrollbar.pack(side=RIGHT)
    #treeview.configure(yscrollcommand=scrollbar.set)
    treeview["columns"] = ["tID", "name",'Number']
    treeview["show"] = "headings"
    treeview.heading("tID", text="Trainer ID")
    treeview.column("tID",minwidth=100,width=100,stretch=NO)
    treeview.heading("name", text="Name")
    treeview.column("name",minwidth=100,width=100,stretch=NO)
    treeview.heading("Number", text="Number")
    treeview.column("Number",minwidth=100,width=100,stretch=NO)
    index = iid = 0
    for row in tviewlist:
        treeview.insert("", index, iid, values=row)
        index = iid = index + 1
    def mvquit():
        ftview.destroy()
    but=Button(ftview,text='Quit',command=mvquit,fg=fgg,bg=bgb,font=fon)
    but.pack(side=TOP)
#####EQUIPMENT COMMANDS#####
def eadd():
    eid=IntVar()
    ename=StringVar()
    etype=StringVar()
    feadd=Frame(root,height=300,width=400,bg=bgb,relief=SUNKEN,borderwidth=3)
    lab=Label(feadd,text='ADD NEW EQUIPMENT',fg=fgg,bg=bgb,font='Arial 15 bold').pack(side=TOP)
    leid=Label(feadd,text='ID',fg=fgg,bg=bgb,font='Arial 13 bold')
    lenam=Label(feadd,text='Name',fg=fgg,bg=bgb,font='Arial 13 bold')
    letype=Label(feadd,text='Type',fg=fgg,bg=bgb,font='Arial 13 bold')
    eeid=Entry(feadd,textvariable=eid)
    eenam=Entry(feadd,textvariable=ename)
    eetype=OptionMenu(feadd,etype,'Running','Cycling','Lifting')
    def reset():
        eeid.delete(0,END)
        eenam.delete(0,END)
        eetype.delete(0,END)
    def submit():
        meid=eid.get()
        menam=ename.get()
        metype=etype.get()
        try:
            inequ="Insert into equptment(eid,ename,etype) values(%s,%s,%s)"
            valequ=(meid,menam,metype)
            c.execute(inequ,valequ)
            mydb.commit()
            messagebox.showinfo('EQUIPMENT Added','Equipment Added')
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
    submit=Button(feadd,text='SUBMIT',width=7,command=submit,fg=fgg,bg=bgb,font='Arial 13 bold')
    reset=Button(feadd,text='RESET',width=7,command=reset,fg=fgg,bg=bgb,font='Arial 13 bold')
    def quiteqp():
        feadd.destroy()
    butquit=Button(feadd,text='QUIT',width=7,command=quiteqp,fg=fgg,bg=bgb,font='Arial 13 bold')
    
    feadd.pack(side=BOTTOM)
    feadd.pack_propagate(0)
    leid.place(x=10,y=50)
    lenam.place(x=10,y=100)
    letype.place(x=10,y=150)
    eeid.place(x=200,y=50)
    eenam.place(x=200,y=100)
    eetype.place(x=200,y=150)
    submit.place(x=25,y=250)
    reset.place(x=125,y=250)
    butquit.place(x=225,y=250)
def eview():
    feview=Frame(root,bg=bgb,relief=SUNKEN,borderwidth=3)
    feview.pack(side=BOTTOM)
    c.execute("SELECT * FROM equptment")
    eviewlist=c.fetchall()
    mydb.commit()
    lab=Label(feview,text='EQUIPMENT INFORMATION',bg=bgb,fg=fgg,font='arial 15 bold').pack(side=TOP)
    treeview = ttk.Treeview(feview)
    style=ttk.Style()
    style.configure("Treeview.Heading",font='Ariel 12 bold',bg='green')
    scrollbar=ttk.Scrollbar(feview,orient='vertical',command=treeview.yview)
    treeview.pack(side=TOP)
    #scrollbar.pack(side=RIGHT,fill=Y)
    treeview.configure(yscrollcommand=scrollbar.set)
    treeview["columns"] = ["EID", "Name",'Type']
    treeview["show"] = "headings"
    treeview.heading("EID", text="Equipment ID")
    treeview.column("EID",minwidth=100,width=100,stretch=NO)
    treeview.heading("Name", text="Name")
    treeview.column("Name",minwidth=100,width=100,stretch=NO)
    treeview.heading("Type", text="Type")
    treeview.column("Type",minwidth=100,width=100,stretch=NO)
    index = iid = 0
    for row in eviewlist:
        treeview.insert("", index, iid, values=row)
        index = iid = index + 1
    def mvquit():
        feview.destroy()
    but=Button(feview,text='Quit',command=mvquit,fg=fgg,bg=bgb,font=fon).pack(side=TOP)
######LOG COMMANDS#####
def ladd():
    fladd=Frame(root,height=300,width=500,bg=bgb,relief=SUNKEN,borderwidth=3)
    fladd.pack(side=BOTTOM,fill=X)
    mid=IntVar()
    tid=IntVar()
    date1=IntVar()
    minutes=IntVar()
    ldate=Label(fladd,text='DATE(yyyymmdd): ',fg=fgg,bg=bgb,font=fon)
    ldate.grid(column=0,row=0)
    lmid=Label(fladd,text='Memeber id:',fg=fgg,bg=bgb,font=fon)
    lmid.grid(column=0,row=1)
    ltid=Label(fladd,text='Trainer id:',fg=fgg,bg=bgb,font=fon)
    ltid.grid(column=0,row=2)
    lhours=Label(fladd,text='Minutes:',fg=fgg,bg=bgb,font=fon)
    lhours.grid(column=0,row=3)
    edat=Entry(fladd,textvariable=date1)
    edat.grid(column=1,row=0)
    emid=Entry(fladd,textvariable=mid)
    emid.grid(column=1,row=1)
    etid=Entry(fladd,textvariable=tid)
    etid.grid(column=1,row=2)
    ehours=Entry(fladd,textvariable=minutes)
    ehours.grid(column=1,row=3)
    def reset():
        edat.delete(0,END)
        emid.delete(0,END)
        etid.delete(0,END)
        ehours.delete(0,END)
    reset
    def submit():
        gtid=tid.get()
        gmid=mid.get()
        gmin=minutes.get()
        gdate=date1.get()
        try:
            inequ="Insert into log(mid,tid,date1,minutes) values(%s,%s,%s,%s)"
            valequ=(gmid,gtid,gdate,gmin)
            c.execute(inequ,valequ)
            mydb.commit()
            reset
            msg='Log entered for member '+str(gmid)
            messagebox.showinfo('Log Enterted',msg)
        except mysql.connector.Error as e:
            messagebox.showinfo('Error',e)
    def tquit():
        fladd.destroy()
    submit=Button(fladd,text="Submit",command=submit,fg=fgg,bg=bgb,font=fon).grid(column=0,row=4)
    reset=Button(fladd,text="Reset",command=reset,fg=fgg,bg=bgb,font=fon).grid(column=1,row=4)
    tquit=Button(fladd,text="Quit",command=tquit,fg=fgg,bg=bgb,font=fon).grid(column=3,row=4)
def lview():
    flview=Frame(root,height=300,width=400,bg=bgb,relief=SUNKEN,borderwidth=3)
    flview.pack(side=BOTTOM,fill=X)
    flview.pack_propagate(0)
    c.execute("SELECT * FROM log order by date1")
    lviewlist=c.fetchall()
    mydb.commit()
    lab=Label(flview,text="LOG IN's",font='arial 15 bold',fg=fgg,bg=bgb).pack(side=TOP)
    treeview = ttk.Treeview(flview)
    #scrollbar=ttk.Scrollbar(flview,orient='vertical',command=treeview.yview)
    treeview.pack(side=TOP)
    #scrollbar.pack(side=RIGHT,fill=Y)
    #treeview.configure(yscrollcommand=scrollbar.set)
    treeview["columns"] = ["LogID", "Member",'Trainer','Date','Minutes']
    treeview["show"] = "headings"
    treeview.heading("LogID", text="Log ID")
    treeview.column("LogID",minwidth=80,width=80,stretch=NO)
    treeview.heading("Member", text="Member id")
    treeview.column("Member",minwidth=100,width=100,stretch=NO)
    treeview.heading("Trainer", text="Trainer ID")
    treeview.column("Trainer",minwidth=100,width=100,stretch=NO)
    treeview.heading("Date", text="Date")
    treeview.column("Date",minwidth=100,width=100,stretch=NO)
    treeview.heading("Minutes", text="Minutes")
    treeview.column("Minutes",minwidth=100,width=100,stretch=NO)
    index = iid = 0
    for row in lviewlist:
        treeview.insert("", index, iid, values=row)
        index = iid = index + 1

    def mvquit():
        flview.destroy()
    but=Button(flview,text='Quit',command=mvquit,fg=fgg,bg=bgb,font=fon).pack(side=TOP)    
###Subs####
def sview():
    fsview=Frame(root,height=300,width=500,relief=SUNKEN,borderwidth=3,bg=bgb)
    fsview.pack(side=BOTTOM)
    c.execute("SELECT * FROM sub")
    sviewlist=c.fetchall()
    mydb.commit()
    lab=Label(fsview,text='SUBSCRIPTION TYPE',font='arial 15 bold',fg=fgg,bg=bgb).pack(side=TOP)
    treeview = ttk.Treeview(fsview)
    #scrollbar=ttk.Scrollbar(fsview,orient='vertical',command=treeview.yview)
    treeview.pack(side=TOP)
    #scrollbar.pack(side=RIGHT,fill=Y)
    #treeview.configure(yscrollcommand=scrollbar.set)
    treeview["columns"] = ["ID", "desc"]
    treeview["show"] = "headings"
    treeview.heading("ID", text="ID")
    treeview.column("ID",minwidth=50,width=50,stretch=NO)
    treeview.heading("desc", text="Description")
    treeview.column("desc",minwidth=100,width=100,stretch=NO)
    index = iid = 0
    for row in sviewlist:
        treeview.insert("", index, iid, values=row)
        index = iid = index + 1
    def mvquit():
        fsview.destroy()
    but=Button(fsview,text='Quit',command=mvquit,fg=fgg,bg=bgb,font=fon).pack(side=TOP)

##connection and gui set up##
mydb=mysql.connector.connect(host="localhost",user="root",passwd="bilwa",database="gym")
c=mydb.cursor()
root=Tk()
root.geometry('1000x600')
root.config(bg='#242422')
root.resizable(0,0)
root.title("Fitness Center Management")
rootbgfile=PhotoImage(file="C:\\Users\\bilwa\\Documents\\FCMProject\\FCM-window-bg.png")
rootbg=Label(root,image=rootbgfile,bg='#242422')
rootbg.place(x=100,y=0)
titlelabel=Label(root,text='FITNESS CENTER MANAGEMENT',font='Arial 40 bold',fg='#8FAE11',bg='#242422',height=2)
titlelabel.place(x=65,y=0)
menu=Menu(root)
member=Menu(menu)
trainer=Menu(menu)
equiptment=Menu(menu)
log=Menu(menu)
subs=Menu(menu)
options=Menu(menu)
menu.add_cascade(label="MEMBER  ",menu=member)
menu.add_cascade(label="TRAINER  ",menu=trainer)
menu.add_cascade(label="EQUIPMENT  ",menu=equiptment)
menu.add_cascade(label="LOGS  ",menu=log)
menu.add_cascade(label="SUBSCRIPTION  ",menu=subs)
menu.add_cascade(label="OPTIONS  ",menu=options)
member.add_command(label='Add Member',command=madd)
member.add_command(label='Delete Member',command=memdelete)
member.add_command(label='Update Member',command=mupdate)
member.add_command(label='View Member',command=mview)
trainer.add_command(label='Add Trainer',command=tadd)
trainer.add_command(label='View',command=tview)
equiptment.add_command(label='Add',command=eadd)
equiptment.add_command(label='View',command=eview)
subs.add_command(label='View',command=sview)
log.add_command(label='Add',command=ladd)
log.add_command(label='View',command=lview)
def endd():
    root.destroy()
def refresh():
    try:
        mydb=mysql.connector.connect(host="localhost",user="root",passwd="bilwa",database="gym")
        mydb.commit()
        messagebox.showinfo('Refresh','Connection refreshed')
    except mysql.connector.Error as e:
        messagebox.showinfo('Error',e)
options.add_command(label='Refresh connection',command=refresh)
options.add_command(label='Quit',command=endd)

##connection and gui close##
mydb.commit()
root.config(menu=menu)
root.mainloop()
mydb.close()

