namespace Draft_Design
{
    partial class Form4
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
            this.button7 = new System.Windows.Forms.Button();
            this.label22 = new System.Windows.Forms.Label();
            this.gv1 = new System.Windows.Forms.DataGridView();
            ((System.ComponentModel.ISupportInitialize)(this.gv1)).BeginInit();
            this.SuspendLayout();
            // 
            // button7
            // 
            this.button7.Location = new System.Drawing.Point(688, 412);
            this.button7.Name = "button7";
            this.button7.Size = new System.Drawing.Size(75, 26);
            this.button7.TabIndex = 1;
            this.button7.Text = "Next";
            this.button7.UseVisualStyleBackColor = true;
            // 
            // label22
            // 
            this.label22.AutoSize = true;
            this.label22.Location = new System.Drawing.Point(37, 19);
            this.label22.Name = "label22";
            this.label22.Size = new System.Drawing.Size(141, 17);
            this.label22.TabIndex = 5;
            this.label22.Text = "Available Shuttle Bus";
            // 
            // gv1
            // 
            this.gv1.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.gv1.Location = new System.Drawing.Point(40, 50);
            this.gv1.Name = "gv1";
            this.gv1.RowHeadersWidth = 51;
            this.gv1.RowTemplate.Height = 24;
            this.gv1.Size = new System.Drawing.Size(723, 330);
            this.gv1.TabIndex = 6;
            // 
            // Form4
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(8F, 16F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.BackColor = System.Drawing.SystemColors.Control;
            this.ClientSize = new System.Drawing.Size(800, 450);
            this.Controls.Add(this.gv1);
            this.Controls.Add(this.label22);
            this.Controls.Add(this.button7);
            this.Name = "Form4";
            this.Text = "Available Shuttle Bus";
            this.Load += new System.EventHandler(this.Form4_Load);
            ((System.ComponentModel.ISupportInitialize)(this.gv1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion
        private System.Windows.Forms.Button button7;
        private System.Windows.Forms.Label label22;
        private System.Windows.Forms.DataGridView gv1;
    }
}