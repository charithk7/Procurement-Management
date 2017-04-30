namespace CBL_DB_SYNC
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.txtTerminal = new System.Windows.Forms.TextBox();
            this.btn_settings = new System.Windows.Forms.Button();
            this.panel_settings = new System.Windows.Forms.Panel();
            this.checkBox_fun_disable = new System.Windows.Forms.CheckBox();
            this.checkBox_btn_hide = new System.Windows.Forms.CheckBox();
            this.txt_request_link = new System.Windows.Forms.TextBox();
            this.groupBox2 = new System.Windows.Forms.GroupBox();
            this.txt_nex_password = new System.Windows.Forms.TextBox();
            this.txt_nex_username = new System.Windows.Forms.TextBox();
            this.txt_nex_port = new System.Windows.Forms.TextBox();
            this.txt_nex_database = new System.Windows.Forms.TextBox();
            this.txt_nex_server = new System.Windows.Forms.TextBox();
            this.label7 = new System.Windows.Forms.Label();
            this.label6 = new System.Windows.Forms.Label();
            this.label5 = new System.Windows.Forms.Label();
            this.label4 = new System.Windows.Forms.Label();
            this.label1 = new System.Windows.Forms.Label();
            this.groupBox1 = new System.Windows.Forms.GroupBox();
            this.txt_access_password = new System.Windows.Forms.TextBox();
            this.txt_access_path = new System.Windows.Forms.TextBox();
            this.btn_browse = new System.Windows.Forms.Button();
            this.label2 = new System.Windows.Forms.Label();
            this.label3 = new System.Windows.Forms.Label();
            this.btn_save = new System.Windows.Forms.Button();
            this.btn_back = new System.Windows.Forms.Button();
            this.label10 = new System.Windows.Forms.Label();
            this.folderBrowserDialog1 = new System.Windows.Forms.FolderBrowserDialog();
            this.openFileDialog1 = new System.Windows.Forms.OpenFileDialog();
            this.button1 = new System.Windows.Forms.Button();
            this.panel_login = new System.Windows.Forms.Panel();
            this.groupBox3 = new System.Windows.Forms.GroupBox();
            this.btn_cancel = new System.Windows.Forms.Button();
            this.btn_login = new System.Windows.Forms.Button();
            this.txt_password = new System.Windows.Forms.TextBox();
            this.txt_username = new System.Windows.Forms.TextBox();
            this.lbl_login_msg = new System.Windows.Forms.Label();
            this.label9 = new System.Windows.Forms.Label();
            this.label8 = new System.Windows.Forms.Label();
            this.button2 = new System.Windows.Forms.Button();
            this.timer1 = new System.Windows.Forms.Timer(this.components);
            this.notifyIcon1 = new System.Windows.Forms.NotifyIcon(this.components);
            this.btn_access_database = new System.Windows.Forms.Button();
            this.btn_my_sql_database = new System.Windows.Forms.Button();
            this.panel_settings.SuspendLayout();
            this.groupBox2.SuspendLayout();
            this.groupBox1.SuspendLayout();
            this.panel_login.SuspendLayout();
            this.groupBox3.SuspendLayout();
            this.SuspendLayout();
            // 
            // txtTerminal
            // 
            this.txtTerminal.BackColor = System.Drawing.SystemColors.ActiveCaptionText;
            this.txtTerminal.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.txtTerminal.Cursor = System.Windows.Forms.Cursors.Default;
            this.txtTerminal.Font = new System.Drawing.Font("Arial", 9F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.txtTerminal.ForeColor = System.Drawing.Color.Lime;
            this.txtTerminal.Location = new System.Drawing.Point(8, 9);
            this.txtTerminal.Multiline = true;
            this.txtTerminal.Name = "txtTerminal";
            this.txtTerminal.ReadOnly = true;
            this.txtTerminal.ScrollBars = System.Windows.Forms.ScrollBars.Vertical;
            this.txtTerminal.Size = new System.Drawing.Size(436, 376);
            this.txtTerminal.TabIndex = 54;
            // 
            // btn_settings
            // 
            this.btn_settings.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_settings.Location = new System.Drawing.Point(450, 9);
            this.btn_settings.Name = "btn_settings";
            this.btn_settings.Size = new System.Drawing.Size(63, 31);
            this.btn_settings.TabIndex = 55;
            this.btn_settings.Text = "Settings";
            this.btn_settings.UseVisualStyleBackColor = true;
            this.btn_settings.Click += new System.EventHandler(this.btn_settings_Click);
            // 
            // panel_settings
            // 
            this.panel_settings.Controls.Add(this.checkBox_fun_disable);
            this.panel_settings.Controls.Add(this.checkBox_btn_hide);
            this.panel_settings.Controls.Add(this.txt_request_link);
            this.panel_settings.Controls.Add(this.groupBox2);
            this.panel_settings.Controls.Add(this.groupBox1);
            this.panel_settings.Controls.Add(this.btn_save);
            this.panel_settings.Controls.Add(this.btn_back);
            this.panel_settings.Controls.Add(this.label10);
            this.panel_settings.Location = new System.Drawing.Point(0, 0);
            this.panel_settings.Name = "panel_settings";
            this.panel_settings.Size = new System.Drawing.Size(361, 392);
            this.panel_settings.TabIndex = 56;
            this.panel_settings.Visible = false;
            // 
            // checkBox_fun_disable
            // 
            this.checkBox_fun_disable.Appearance = System.Windows.Forms.Appearance.Button;
            this.checkBox_fun_disable.AutoSize = true;
            this.checkBox_fun_disable.Checked = true;
            this.checkBox_fun_disable.CheckState = System.Windows.Forms.CheckState.Checked;
            this.checkBox_fun_disable.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.checkBox_fun_disable.Location = new System.Drawing.Point(265, 9);
            this.checkBox_fun_disable.Name = "checkBox_fun_disable";
            this.checkBox_fun_disable.Size = new System.Drawing.Size(111, 23);
            this.checkBox_fun_disable.TabIndex = 9;
            this.checkBox_fun_disable.Text = "Disable GRN SYNC";
            this.checkBox_fun_disable.UseVisualStyleBackColor = true;
            this.checkBox_fun_disable.CheckedChanged += new System.EventHandler(this.checkBox_fun_disable_CheckedChanged);
            // 
            // checkBox_btn_hide
            // 
            this.checkBox_btn_hide.Appearance = System.Windows.Forms.Appearance.Button;
            this.checkBox_btn_hide.AutoSize = true;
            this.checkBox_btn_hide.Checked = true;
            this.checkBox_btn_hide.CheckState = System.Windows.Forms.CheckState.Checked;
            this.checkBox_btn_hide.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.checkBox_btn_hide.Location = new System.Drawing.Point(411, 7);
            this.checkBox_btn_hide.Name = "checkBox_btn_hide";
            this.checkBox_btn_hide.Size = new System.Drawing.Size(73, 23);
            this.checkBox_btn_hide.TabIndex = 9;
            this.checkBox_btn_hide.Text = "Button Hide";
            this.checkBox_btn_hide.UseVisualStyleBackColor = true;
            this.checkBox_btn_hide.CheckedChanged += new System.EventHandler(this.checkBox_btn_hide_CheckedChanged);
            this.checkBox_btn_hide.CheckStateChanged += new System.EventHandler(this.checkBox_btn_hide_CheckStateChanged);
            // 
            // txt_request_link
            // 
            this.txt_request_link.Location = new System.Drawing.Point(165, 351);
            this.txt_request_link.Name = "txt_request_link";
            this.txt_request_link.Size = new System.Drawing.Size(183, 20);
            this.txt_request_link.TabIndex = 8;
            // 
            // groupBox2
            // 
            this.groupBox2.Controls.Add(this.txt_nex_password);
            this.groupBox2.Controls.Add(this.txt_nex_username);
            this.groupBox2.Controls.Add(this.txt_nex_port);
            this.groupBox2.Controls.Add(this.txt_nex_database);
            this.groupBox2.Controls.Add(this.txt_nex_server);
            this.groupBox2.Controls.Add(this.label7);
            this.groupBox2.Controls.Add(this.label6);
            this.groupBox2.Controls.Add(this.label5);
            this.groupBox2.Controls.Add(this.label4);
            this.groupBox2.Controls.Add(this.label1);
            this.groupBox2.Location = new System.Drawing.Point(15, 170);
            this.groupBox2.Name = "groupBox2";
            this.groupBox2.Size = new System.Drawing.Size(448, 168);
            this.groupBox2.TabIndex = 7;
            this.groupBox2.TabStop = false;
            this.groupBox2.Text = "NEXSOFT DATABASE";
            // 
            // txt_nex_password
            // 
            this.txt_nex_password.Location = new System.Drawing.Point(150, 134);
            this.txt_nex_password.Name = "txt_nex_password";
            this.txt_nex_password.PasswordChar = '*';
            this.txt_nex_password.Size = new System.Drawing.Size(183, 20);
            this.txt_nex_password.TabIndex = 2;
            // 
            // txt_nex_username
            // 
            this.txt_nex_username.Location = new System.Drawing.Point(150, 110);
            this.txt_nex_username.Name = "txt_nex_username";
            this.txt_nex_username.Size = new System.Drawing.Size(183, 20);
            this.txt_nex_username.TabIndex = 2;
            // 
            // txt_nex_port
            // 
            this.txt_nex_port.Location = new System.Drawing.Point(150, 87);
            this.txt_nex_port.Name = "txt_nex_port";
            this.txt_nex_port.Size = new System.Drawing.Size(183, 20);
            this.txt_nex_port.TabIndex = 2;
            // 
            // txt_nex_database
            // 
            this.txt_nex_database.Location = new System.Drawing.Point(150, 63);
            this.txt_nex_database.Name = "txt_nex_database";
            this.txt_nex_database.Size = new System.Drawing.Size(183, 20);
            this.txt_nex_database.TabIndex = 2;
            // 
            // txt_nex_server
            // 
            this.txt_nex_server.Location = new System.Drawing.Point(150, 38);
            this.txt_nex_server.Name = "txt_nex_server";
            this.txt_nex_server.Size = new System.Drawing.Size(183, 20);
            this.txt_nex_server.TabIndex = 2;
            // 
            // label7
            // 
            this.label7.AutoSize = true;
            this.label7.Location = new System.Drawing.Point(9, 137);
            this.label7.Name = "label7";
            this.label7.Size = new System.Drawing.Size(70, 13);
            this.label7.TabIndex = 1;
            this.label7.Text = "PASSWORD";
            // 
            // label6
            // 
            this.label6.AutoSize = true;
            this.label6.Location = new System.Drawing.Point(9, 113);
            this.label6.Name = "label6";
            this.label6.Size = new System.Drawing.Size(71, 13);
            this.label6.TabIndex = 1;
            this.label6.Text = "USER NAME";
            // 
            // label5
            // 
            this.label5.AutoSize = true;
            this.label5.Location = new System.Drawing.Point(9, 87);
            this.label5.Name = "label5";
            this.label5.Size = new System.Drawing.Size(37, 13);
            this.label5.TabIndex = 1;
            this.label5.Text = "PORT";
            // 
            // label4
            // 
            this.label4.AutoSize = true;
            this.label4.Location = new System.Drawing.Point(9, 66);
            this.label4.Name = "label4";
            this.label4.Size = new System.Drawing.Size(64, 13);
            this.label4.TabIndex = 1;
            this.label4.Text = "DATABASE";
            // 
            // label1
            // 
            this.label1.AutoSize = true;
            this.label1.Location = new System.Drawing.Point(9, 41);
            this.label1.Name = "label1";
            this.label1.Size = new System.Drawing.Size(51, 13);
            this.label1.TabIndex = 1;
            this.label1.Text = "SERVER";
            // 
            // groupBox1
            // 
            this.groupBox1.Controls.Add(this.txt_access_password);
            this.groupBox1.Controls.Add(this.txt_access_path);
            this.groupBox1.Controls.Add(this.btn_browse);
            this.groupBox1.Controls.Add(this.label2);
            this.groupBox1.Controls.Add(this.label3);
            this.groupBox1.Location = new System.Drawing.Point(15, 40);
            this.groupBox1.Name = "groupBox1";
            this.groupBox1.Size = new System.Drawing.Size(448, 109);
            this.groupBox1.TabIndex = 6;
            this.groupBox1.TabStop = false;
            this.groupBox1.Text = "CBL DATABASE";
            // 
            // txt_access_password
            // 
            this.txt_access_password.Location = new System.Drawing.Point(150, 62);
            this.txt_access_password.Name = "txt_access_password";
            this.txt_access_password.PasswordChar = '*';
            this.txt_access_password.Size = new System.Drawing.Size(183, 20);
            this.txt_access_password.TabIndex = 6;
            // 
            // txt_access_path
            // 
            this.txt_access_path.Location = new System.Drawing.Point(150, 37);
            this.txt_access_path.Name = "txt_access_path";
            this.txt_access_path.Size = new System.Drawing.Size(183, 20);
            this.txt_access_path.TabIndex = 4;
            // 
            // btn_browse
            // 
            this.btn_browse.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_browse.Location = new System.Drawing.Point(339, 34);
            this.btn_browse.Name = "btn_browse";
            this.btn_browse.Size = new System.Drawing.Size(65, 23);
            this.btn_browse.TabIndex = 5;
            this.btn_browse.Text = "Browse";
            this.btn_browse.UseVisualStyleBackColor = true;
            this.btn_browse.Click += new System.EventHandler(this.btn_browse_Click);
            // 
            // label2
            // 
            this.label2.AutoSize = true;
            this.label2.Location = new System.Drawing.Point(11, 40);
            this.label2.Name = "label2";
            this.label2.Size = new System.Drawing.Size(99, 13);
            this.label2.TabIndex = 1;
            this.label2.Text = "ACCESS DB PATH";
            // 
            // label3
            // 
            this.label3.AutoSize = true;
            this.label3.Location = new System.Drawing.Point(9, 69);
            this.label3.Name = "label3";
            this.label3.Size = new System.Drawing.Size(133, 13);
            this.label3.TabIndex = 1;
            this.label3.Text = "ACCESS DB PASSWORD";
            // 
            // btn_save
            // 
            this.btn_save.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_save.Location = new System.Drawing.Point(419, 362);
            this.btn_save.Name = "btn_save";
            this.btn_save.Size = new System.Drawing.Size(65, 23);
            this.btn_save.TabIndex = 3;
            this.btn_save.Text = "Save";
            this.btn_save.UseVisualStyleBackColor = true;
            this.btn_save.Click += new System.EventHandler(this.btn_save_Click);
            // 
            // btn_back
            // 
            this.btn_back.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_back.Location = new System.Drawing.Point(3, 3);
            this.btn_back.Name = "btn_back";
            this.btn_back.Size = new System.Drawing.Size(72, 22);
            this.btn_back.TabIndex = 0;
            this.btn_back.Text = "Back";
            this.btn_back.UseVisualStyleBackColor = true;
            this.btn_back.Click += new System.EventHandler(this.btn_back_Click);
            // 
            // label10
            // 
            this.label10.AutoSize = true;
            this.label10.Location = new System.Drawing.Point(25, 354);
            this.label10.Name = "label10";
            this.label10.Size = new System.Drawing.Size(86, 13);
            this.label10.TabIndex = 1;
            this.label10.Text = "REQUEST LINK";
            // 
            // folderBrowserDialog1
            // 
            this.folderBrowserDialog1.ShowNewFolderButton = false;
            // 
            // openFileDialog1
            // 
            this.openFileDialog1.FileName = "openFileDialog1";
            // 
            // button1
            // 
            this.button1.Location = new System.Drawing.Point(450, 115);
            this.button1.Name = "button1";
            this.button1.Size = new System.Drawing.Size(63, 23);
            this.button1.TabIndex = 57;
            this.button1.Text = "DB sync";
            this.button1.UseVisualStyleBackColor = true;
            this.button1.Visible = false;
            this.button1.Click += new System.EventHandler(this.button1_Click);
            // 
            // panel_login
            // 
            this.panel_login.BackColor = System.Drawing.SystemColors.WindowText;
            this.panel_login.Controls.Add(this.groupBox3);
            this.panel_login.ForeColor = System.Drawing.Color.CornflowerBlue;
            this.panel_login.Location = new System.Drawing.Point(94, 86);
            this.panel_login.Name = "panel_login";
            this.panel_login.Size = new System.Drawing.Size(303, 184);
            this.panel_login.TabIndex = 58;
            this.panel_login.Visible = false;
            // 
            // groupBox3
            // 
            this.groupBox3.AccessibleRole = System.Windows.Forms.AccessibleRole.Window;
            this.groupBox3.Anchor = ((System.Windows.Forms.AnchorStyles)((((System.Windows.Forms.AnchorStyles.Top | System.Windows.Forms.AnchorStyles.Bottom) 
            | System.Windows.Forms.AnchorStyles.Left) 
            | System.Windows.Forms.AnchorStyles.Right)));
            this.groupBox3.BackColor = System.Drawing.Color.Transparent;
            this.groupBox3.BackgroundImageLayout = System.Windows.Forms.ImageLayout.None;
            this.groupBox3.Controls.Add(this.btn_cancel);
            this.groupBox3.Controls.Add(this.btn_login);
            this.groupBox3.Controls.Add(this.txt_password);
            this.groupBox3.Controls.Add(this.txt_username);
            this.groupBox3.Controls.Add(this.lbl_login_msg);
            this.groupBox3.Controls.Add(this.label9);
            this.groupBox3.Controls.Add(this.label8);
            this.groupBox3.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.groupBox3.ForeColor = System.Drawing.Color.Lime;
            this.groupBox3.Location = new System.Drawing.Point(17, 17);
            this.groupBox3.Name = "groupBox3";
            this.groupBox3.RightToLeft = System.Windows.Forms.RightToLeft.No;
            this.groupBox3.Size = new System.Drawing.Size(271, 150);
            this.groupBox3.TabIndex = 0;
            this.groupBox3.TabStop = false;
            this.groupBox3.Text = "Admin Login";
            // 
            // btn_cancel
            // 
            this.btn_cancel.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_cancel.Location = new System.Drawing.Point(109, 121);
            this.btn_cancel.Name = "btn_cancel";
            this.btn_cancel.Size = new System.Drawing.Size(75, 23);
            this.btn_cancel.TabIndex = 4;
            this.btn_cancel.Text = "CANCEL";
            this.btn_cancel.UseVisualStyleBackColor = true;
            this.btn_cancel.Click += new System.EventHandler(this.btn_cancel_Click);
            // 
            // btn_login
            // 
            this.btn_login.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_login.Location = new System.Drawing.Point(190, 121);
            this.btn_login.Name = "btn_login";
            this.btn_login.Size = new System.Drawing.Size(75, 23);
            this.btn_login.TabIndex = 3;
            this.btn_login.Text = "LOGIN";
            this.btn_login.UseVisualStyleBackColor = true;
            this.btn_login.Click += new System.EventHandler(this.btn_login_Click);
            // 
            // txt_password
            // 
            this.txt_password.Location = new System.Drawing.Point(99, 84);
            this.txt_password.Name = "txt_password";
            this.txt_password.PasswordChar = '*';
            this.txt_password.Size = new System.Drawing.Size(164, 20);
            this.txt_password.TabIndex = 2;
            this.txt_password.KeyPress += new System.Windows.Forms.KeyPressEventHandler(this.txt_password_KeyPress);
            // 
            // txt_username
            // 
            this.txt_username.Location = new System.Drawing.Point(99, 53);
            this.txt_username.Name = "txt_username";
            this.txt_username.Size = new System.Drawing.Size(164, 20);
            this.txt_username.TabIndex = 1;
            // 
            // lbl_login_msg
            // 
            this.lbl_login_msg.AutoSize = true;
            this.lbl_login_msg.ForeColor = System.Drawing.Color.Red;
            this.lbl_login_msg.Location = new System.Drawing.Point(100, 22);
            this.lbl_login_msg.Name = "lbl_login_msg";
            this.lbl_login_msg.Size = new System.Drawing.Size(0, 13);
            this.lbl_login_msg.TabIndex = 0;
            // 
            // label9
            // 
            this.label9.AutoSize = true;
            this.label9.Location = new System.Drawing.Point(19, 87);
            this.label9.Name = "label9";
            this.label9.Size = new System.Drawing.Size(53, 13);
            this.label9.TabIndex = 0;
            this.label9.Text = "Password";
            // 
            // label8
            // 
            this.label8.AutoSize = true;
            this.label8.Location = new System.Drawing.Point(19, 53);
            this.label8.Name = "label8";
            this.label8.Size = new System.Drawing.Size(55, 13);
            this.label8.TabIndex = 0;
            this.label8.Text = "Username";
            // 
            // button2
            // 
            this.button2.Location = new System.Drawing.Point(450, 75);
            this.button2.Name = "button2";
            this.button2.Size = new System.Drawing.Size(63, 23);
            this.button2.TabIndex = 59;
            this.button2.Text = "Link Call";
            this.button2.UseVisualStyleBackColor = true;
            this.button2.Visible = false;
            this.button2.Click += new System.EventHandler(this.button2_Click);
            // 
            // timer1
            // 
            this.timer1.Interval = 60000;
            this.timer1.Tick += new System.EventHandler(this.timer1_Tick);
            // 
            // notifyIcon1
            // 
            this.notifyIcon1.BalloonTipIcon = System.Windows.Forms.ToolTipIcon.Info;
            this.notifyIcon1.BalloonTipText = "Software is running ";
            this.notifyIcon1.BalloonTipTitle = "CBL Synchronize Software";
            this.notifyIcon1.Icon = ((System.Drawing.Icon)(resources.GetObject("notifyIcon1.Icon")));
            this.notifyIcon1.Text = "CBL Synchronizing";
            this.notifyIcon1.Visible = true;
            this.notifyIcon1.MouseClick += new System.Windows.Forms.MouseEventHandler(this.notifyIcon1_MouseClick);
            this.notifyIcon1.MouseDoubleClick += new System.Windows.Forms.MouseEventHandler(this.notifyIcon1_MouseDoubleClick);
            // 
            // btn_access_database
            // 
            this.btn_access_database.BackColor = System.Drawing.Color.Red;
            this.btn_access_database.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_access_database.ForeColor = System.Drawing.SystemColors.ControlText;
            this.btn_access_database.Location = new System.Drawing.Point(450, 151);
            this.btn_access_database.Name = "btn_access_database";
            this.btn_access_database.Size = new System.Drawing.Size(63, 52);
            this.btn_access_database.TabIndex = 57;
            this.btn_access_database.Text = "Access Database";
            this.btn_access_database.UseVisualStyleBackColor = false;
            // 
            // btn_my_sql_database
            // 
            this.btn_my_sql_database.BackColor = System.Drawing.Color.Red;
            this.btn_my_sql_database.FlatStyle = System.Windows.Forms.FlatStyle.Flat;
            this.btn_my_sql_database.Location = new System.Drawing.Point(448, 224);
            this.btn_my_sql_database.Name = "btn_my_sql_database";
            this.btn_my_sql_database.Size = new System.Drawing.Size(63, 53);
            this.btn_my_sql_database.TabIndex = 57;
            this.btn_my_sql_database.Text = "Mysql Database";
            this.btn_my_sql_database.UseVisualStyleBackColor = false;
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(525, 404);
            this.Controls.Add(this.button2);
            this.Controls.Add(this.panel_login);
            this.Controls.Add(this.panel_settings);
            this.Controls.Add(this.btn_settings);
            this.Controls.Add(this.btn_my_sql_database);
            this.Controls.Add(this.btn_access_database);
            this.Controls.Add(this.button1);
            this.Controls.Add(this.txtTerminal);
            this.DoubleBuffered = true;
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.Icon = ((System.Drawing.Icon)(resources.GetObject("$this.Icon")));
            this.Name = "Form1";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "CBL Synchronizing";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.Resize += new System.EventHandler(this.Form1_Resize);
            this.panel_settings.ResumeLayout(false);
            this.panel_settings.PerformLayout();
            this.groupBox2.ResumeLayout(false);
            this.groupBox2.PerformLayout();
            this.groupBox1.ResumeLayout(false);
            this.groupBox1.PerformLayout();
            this.panel_login.ResumeLayout(false);
            this.groupBox3.ResumeLayout(false);
            this.groupBox3.PerformLayout();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        public System.Windows.Forms.TextBox txtTerminal;
        private System.Windows.Forms.Button btn_settings;
        private System.Windows.Forms.Panel panel_settings;
        private System.Windows.Forms.Button btn_back;
        private System.Windows.Forms.Button btn_save;
        private System.Windows.Forms.TextBox txt_nex_server;
        private System.Windows.Forms.Label label1;
        private System.Windows.Forms.TextBox txt_access_path;
        private System.Windows.Forms.FolderBrowserDialog folderBrowserDialog1;
        private System.Windows.Forms.Button btn_browse;
        private System.Windows.Forms.OpenFileDialog openFileDialog1;
        private System.Windows.Forms.Button button1;
        private System.Windows.Forms.GroupBox groupBox1;
        private System.Windows.Forms.GroupBox groupBox2;
        private System.Windows.Forms.TextBox txt_access_password;
        private System.Windows.Forms.Label label3;
        private System.Windows.Forms.Label label7;
        private System.Windows.Forms.Label label6;
        private System.Windows.Forms.Label label5;
        private System.Windows.Forms.Label label4;
        private System.Windows.Forms.TextBox txt_nex_password;
        private System.Windows.Forms.TextBox txt_nex_username;
        private System.Windows.Forms.TextBox txt_nex_port;
        private System.Windows.Forms.TextBox txt_nex_database;
        private System.Windows.Forms.Panel panel_login;
        private System.Windows.Forms.GroupBox groupBox3;
        private System.Windows.Forms.TextBox txt_username;
        private System.Windows.Forms.Label label9;
        private System.Windows.Forms.Label label8;
        private System.Windows.Forms.Button btn_cancel;
        private System.Windows.Forms.Button btn_login;
        private System.Windows.Forms.TextBox txt_password;
        private System.Windows.Forms.Label lbl_login_msg;
        private System.Windows.Forms.Button button2;
        private System.Windows.Forms.Timer timer1;
        private System.Windows.Forms.TextBox txt_request_link;
        private System.Windows.Forms.Label label10;
        private System.Windows.Forms.CheckBox checkBox_btn_hide;
        private System.Windows.Forms.NotifyIcon notifyIcon1;
        private System.Windows.Forms.CheckBox checkBox_fun_disable;
        private System.Windows.Forms.Label label2;
        private System.Windows.Forms.Button btn_access_database;
        private System.Windows.Forms.Button btn_my_sql_database;
    }
}

